#! /bin/bash

SILENCE_SEC=$1 # Silent second at start
SPEECH=$2 # Voice Speech
SOUND=$3 # Background music
DROP_SEC=$4 # After many second drop music
WAV_OUT=$5

# Generate silence
ffmpeg -f lavfi -i anullsrc=channel_layout=5.1:sample_rate=48000 -t $SILENCE_SEC -y silence_$SILENCE_SEC.wav

# Overlap Music and Voice
ffmpeg -i $SPEECH -i $SOUND -filter_complex amix=inputs=2:duration=longest -y tmp_out_merge.wav

# Drop Merged Message
ffmpeg -i tmp_out_merge.wav -c copy -t 00:00:$DROP_SEC.0 -y tmp_out_crop.wav

# Fade Out dropped message
FADE_OUT_L="0:3"
LENGTH=`soxi -d tmp_out_crop.wav`
echo $LENGTH
sox tmp_out_crop.wav tmp_out_fade.wav fade 0 $LENGTH $FADE_OUT_L

# Concat all file
ffmpeg -i silence_$SILENCE_SEC.wav -i tmp_out_fade.wav  -filter_complex '[0:0][1:0]concat=n=2:v=0:a=1[out]' -map '[out]' -y $WAV_OUT

# ffmpeg -i google.wav -i MoHNewElfin.wav -filter_complex amix=inputs=2:duration=shortest output2.wav
# ffmpeg -i output.wav -c copy -t 00:00:50.0 out_crop.wav
# ffmpeg -i silence.wav -i output.wav -i google.wav -filter_complex '[0:0][1:0][2:0]concat=n=3:v=0:a=1[out]' -map '[out]' concat.wav
# ffmpeg -f lavfi -i anullsrc=channel_layout=5.1:sample_rate=48000 -t 1 silence.wav
