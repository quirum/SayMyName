'use strict';

// [START vision_quickstart]
var argv = require('optimist').argv;
var child_process = require('child_process');
const fs = require('fs');

// Imports the Google Cloud client library
const textToSpeech = require('@google-cloud/text-to-speech');

// Creates a client
const client = new textToSpeech.TextToSpeechClient();

// The text to synthesize
const text = argv.text;

// Lang
const lang = argv.lang;

var voice = {languageCode: 'it-IT', name: 'it-IT-Wavenet-A', ssmlGender: 'FEMALE'}

if(lang == undefined || lang == 'IT' )
	voice = {languageCode: 'it-IT', name: 'it-IT-Wavenet-A', ssmlGender: 'FEMALE'}
else
	voice = {languageCode: 'en-US', name: 'en-US-Wavenet-C', ssmlGender: 'FEMALE'}
	

// Construct the request
const request = {
	input: {text: text},
     	// Select the language and SSML Voice Gender (optional)
       	//voice: {languageCode: 'pt-BR', ssmlGender: 'en-US-Wavenet-F'},
        voice: voice,
        // Select the type of audio encoding
        audioConfig: {audioEncoding: 'MP3'},
};

// Performs the Text-to-Speech request
client.synthesizeSpeech(request, (err, response) => {
	if (err) {
        	console.error('ERROR:', err);
                return;
       	}

	// Write the binary audio content to a local file
	fs.writeFile(argv.mp3, response.audioContent, 'binary', err => {
		if (err) {
			console.error('ERROR:', err);
        		return;
		}	

		console.log('Audio content written to file: output.mp3');
		var output = child_process.execSync('lame --decode ' + argv.mp3 + ' ' + '-b 8000' + ' ' + argv.wav + '.wav');
	});
});
