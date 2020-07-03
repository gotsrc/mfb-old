<?php

function bb_code($text) {
	// $text = $str_replace("[b]","<b>", $text);
	// $text = $str_replace("[/b]","</b>", $text);
	// $text = $str_replace("[u]","<u>", $text);
	// $text = $str_replace("[/u]","</u>", $text); // Parse all of the ubb code and those darn cute smiley faces :)
	
	$tagArray['b']			=	array('open'=>'<b>','close'=>'</b>');
	$tagArray['i']			= 	array('open'=>'<i>','close'=>'</i>');
	$tagArray['u']			=	array('open'=>'<u>','close'=>'</u>');
	$tagArray['s']			= 	array('open'=>'<s>','close'=>'</s>');
	$tagArray['sup']		= 	array('open'=>'<sup>','close'=>'</sup>');
	$tagArray['sub']		= 	array('open'=>'<sub>','close'=>'</sub>');
	$tagArray['center']		= 	array('open'=>'<div style="text-align: center">','close'=>'</div>');
	$tagArray['url']		= 	array('open'=>'<a class="name" target="_blank" href="','close'=>'">\\1</a>');
	$tagArray['email']		=	array('open'=>'<a class="name" target="_blank" href="mailto:','close'=>'">\\1</a>');
	$tagArray['url=(.*)']	= 	array('open'=>'<a class="name" target="_blank" href="','close'=>'">\\2</a>');
	$tagArray['quote']		= 	array('open'=>'<div id="quote">','close'=>'</div');
	$tagArray['email=(.*)']	= 	array('open'=>'<a class="name" target="_blank" href="mailto:','close'=>'">\\2</a>');
	$tagArray['color=(.*)']	= 	array('open'=>'<font color="','close'=>'">\\2</font>');

	foreach($tagArray as $tagName=>$replace) 
	{
		$tagEnd=preg_replace('/\W/Ui','',$tagName);
		$text = preg_replace("|\[$tagName\](.*)\[/$tagEnd\]|Ui","$replace[open]\\1$replace[close]",$text);
		$text = str_replace(chr(13).chr(10), '<br />', $text);
	}

	$smilies = array(
					":leet:"		=>	"1337",
					">:("			=>	"angry",
					":banana:"		=>	"banana",
					":beer:"		=>	"beer",
					":D"			=>	"biggrin",
					":blah:"		=>	"blahblah",
					":$"			=>	"blush",
					":code:"		=>	"code",
					":huh:"			=>	"confused",
					"8)"			=>	"cool",
					":'("			=>	"cry",
					":ditto:"		=>	"ditto",
					"o.O"			=>	"eek",
					":fence:"		=>	"fencing",
					":google:"		=>	"google",
					":help:"		=>	"help",
					":kitty:"		=>	"kitty",
					":lol:"			=>	"lol",
					":|"			=>	"neutral",
					":offtopic:"	=>	"offtopic",
					":crash:"		=>	"pccrash",
					":die:"			=>	"plzdie",
					":p"			=>	"razz",
					":P"			=>	"razz",
					"8-)"			=>	"rolleyes",
					":("			=>	"sad",
					"=["			=>	"sad",
					"=("			=>	"sad",
					":)"			=>	"smile",
					"=]"			=>	"smile",
					"=)"			=>	"smile",
					":smooch:"		=>	"smooch",
					":spank:"		=>	"spanked",
					":stfu:"		=>	"stfu",
					":stupid:"		=>	"stupid",
					":o"			=>	"surprised",
					":fail:"		=>	"thmbdown",
					"(N)"			=>	"thumbdown",
					"(Y)"			=>	"thumbup",
					":twak:"		=>	"twak",
					"xD"			=>	"twisted",
					":wall:"		=>	"wall",
					";)"			=>	"wink",
					";]"			=>	"wink",
					":wtf:"			=>	"wtf"
				);
				
	foreach($smilies as $smile_code=>$smile_name) 
	{
		$text = str_replace("$smile_code", "<img src=\"./images/emoticons/icon_$smile_name.gif\" border=\"0\" />", "$text");
	}
	
	return $text;

	}
?>