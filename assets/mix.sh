#! /bin/bash

SILENCE_SEC=$1 # Retard message second at start
SPEECH=$2 # Voice Speech
SOUND=$3 # Background music
DROP_SEC=$4 # After many second drop music (max 59 sec)
FADE_TIME=$5 # How long fade out (max 59 sec)
WAV_OUT=$6 # Name of output file


# Generate silence
if [ "$SILENCE_SEC" -ne "0" ]; then
    ffmpeg -f lavfi -i anullsrc=channel_layout=5.1:sample_rate=48000 -t $SILENCE_SEC -y silence_$SILENCE_SEC.wav
    ffmpeg -i $SPEECH -af "volume=2" ${SPEECH}_high.wav
    # Retard Voice
    ffmpeg -i silence_$SILENCE_SEC.wav -i ${SPEECH}_high.wav  -filter_complex '[0:0][1:0]concat=n=2:v=0:a=1[out]' -map '[out]' -y ${SPEECH}_retarded.wav
else
    ffmpeg -i $SPEECH -af "volume=2" ${SPEECH}_retarded.wav
fi

# Overlap Music and Voice
if [ "$SOUND" != "no_sound" ]; then
    ffmpeg -i ${SPEECH}_retarded.wav -i $SOUND -filter_complex amix=inputs=2:duration=longest -y tmp_out_merge.wav
else
    cp ${SPEECH}_retarded.wav tmp_out_merge.wav
fi

# Drop Merged Message
if [ "$DROP_SEC" -ne "0" ]; then

    ffmpeg -i tmp_out_merge.wav -c copy -t 00:00:$DROP_SEC.0 -y tmp_out_crop.wav

    # Fade Out dropped message
    if [ "$FADE_TIME" -eq "0" ]; then
        cp tmp_out_crop.wav $WAV_OUT
    else
        FADE_OUT_L="0:$FADE_TIME"
        LENGTH=`soxi -d tmp_out_crop.wav`
        sox tmp_out_crop.wav $WAV_OUT fade 0 $LENGTH $FADE_OUT_L
    fi
else
    cp tmp_out_merge.wav $WAV_OUT
fi

rm silence_$SILENCE_SEC.wav
rm ${SPEECH}_high.wav
rm ${SPEECH}_retarded.wav
rm tmp_*.wav

# ffmpeg -i google.wav -i MoHNewElfin.wav -filter_complex amix=inputs=2:duration=shortest output2.wav
# ffmpeg -i output.wav -c copy -t 00:00:50.0 out_crop.wav
# ffmpeg -i silence.wav -i output.wav -i google.wav -filter_complex '[0:0][1:0][2:0]concat=n=3:v=0:a=1[out]' -map '[out]' concat.wav
# ffmpeg -f lavfi -i anullsrc=channel_layout=5.1:sample_rate=48000 -t 1 silence.wav
