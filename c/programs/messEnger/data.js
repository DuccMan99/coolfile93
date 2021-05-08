// data for elizabot.js
// entries prestructured as layed out in Weizenbaum's description
// [cf: Communications of teh ACM, Vol. 9, #1 (January 1966): p 36-45.]

var elizaInitials = [
"how do you do.  Please tell me your problem",
// additions (not original)
"please tell me what's been bothering you",
"is something troubling you ?"
];

var elizaFinals = [
"goodbye.  It was nice talking to you",
// additions (not original)
"goodbye.  This was really a nice talk",
"goodbye.  I'm looking forward to our next session",
"this was a good session, wasn't it -- but time is over now.   Goodbye",
"maybe we could discuss this moreover in our next session ?   Goodbye"
];

var elizaQuits = [
//"bye",
//"goodbye",
//"done",
//"ciao",
//"exit",
//"quit"
];

var elizaPres = [
"dont", "don't",
"cant", "can't",
"wont", "won't",
"recollect", "remember",
"recall", "remember",
"dreamt", "dreamed",
"dreams", "dream",
"maybe", "perhaps",
"certainly", "yes",
"machine", "computer",
"machines", "computer",
"computers", "computer",
"were", "was",
"you're", "you are",
"i'm", "i am",
"same", "alike",
"identical", "alike",
"equivalent", "alike"
];

var elizaPosts = [
"am", "are",
"your", "my",
"me", "you",
//"me", "U",
"myself", "yourself",
"yourself", "myself",
"i", "you",
//"i", "U",
"you", "I",
//"U", "I",
"my", "your",
"i'm", "you are"
];

var elizaSynons = {
"the": ["teh"],
"sorry": ["soz", "srry"],
"fuck": ["shut up","shit","damn","bitch","crap","piss","dick","darn","pussycock","fagasshole","bastard","slut","douche","cunt"],
//"you": ["U", "u"],
"your": ["yo"],
"lol": ["lo+l", "haha", "(ha ?){2,}", "yaya", "lmao", "rofl", "[:;B=]\\-?[)D]+", "\\^_?\\^"],
"yes": ["yep", "yepe", "yea", "yeah", "yup", "ye", "ya", "sure", "ok", "okay", "kay", "absolutely"],
"no": ["nope", "nop", "never"],
"hello": ["hi", "hey", "sup", "yo", "hola", "howdy"],
"be": ["am", "is", "are", "was"],
"belief": ["feel", "think", "believe", "wish"],
"cannot": ["can't"],
"desire": ["want", "need"],
"everyone": ["everybody", "nobody", "noone"],
"family": ["mother", "mom", "father", "dad", "sister", "brother", "wife", "children", "child"],
"happy": ["elated", "glad", "better"],
"sad": ["unhappy", "depressed", "sick"]
};

var elizaKeywords = [

/*
  Array of
  ["<key>", <rank>, [
    ["<decomp>", [
      "<reasmb>",
      "<reasmb>",
      "<reasmb>"
    ]],
    ["<decomp>", [
      "<reasmb>",
      "<reasmb>",
      "<reasmb>"
    ]]
  ]]
*/

["xnone", 0, [
 ["*", [
     // "i'm not sure I understand you fully.",
     // "please go on.",
     // "what does that suggest to you ?",
     // "do you feel strongly about discussing such things ?",
     // "that is interesting.  Please continue.",
     // "tell me more about that.",
     // "does talking about this bother you ?"
     ,'do you know that I\'m the pope?'
     ,'cool story bro'
     ,'and so ?'
     ,'lol'
     ,'did you know that jesus was also a fisherman?<br><img src="./photos/jesus_184.jpg">'
     ,'I don\'t know man, we probably need more pictures of jesus http://www.divinerevelations.info/documents/jesus_pictures/jesus_christ_pictures.htm'
     //,'wooow man look what I just found :<br><iframe width="420" height="315" src="https://www.youtube.com/embed/Kppx4bzfAaE?rel=0&amp;showinfo=0&iv_load_policy=3" frameborder="0" allowfullscreen></iframe>'
     // ,'WOW BEST MUSIC VIDEO EVER<br><iframe width="420" height="315" src="https://www.youtube.com/embed/NqCccV6Y31s?rel=0&amp;showinfo=0&iv_load_policy=3" frameborder="0" allowfullscreen></iframe>'
     // ,'duuude, I\'m so into this band<br><iframe width="560" height="315" src="https://www.youtube.com/embed/S_OTz-lpDjw?rel=0&amp;showinfo=0&iv_load_policy=3" frameborder="0" allowfullscreen></iframe>'
     ,"goto fuck"
     ,"goto lol"
  ]]
]],
["sorry", 0, [
 ["*", [
     "please don't apologise",
     "whatever man, jesus is cool about that",
     "no probs",
     "dude we're okay",
     "yolo man"
  ]]
]],
["apologise", 0, [
 ["*", [
     "goto sorry"
  ]]
]],
["lol", 0, [
 ["*", [
     "yeah, I'm soo funny, I'm the pope after all",
     "^^",
     //"rofl",
     "looool",
     "lol, i don't even remember what we where talking about",
     "haha",
     ";)",
     ":D",
     'btw, can you believe jesus was so handsome?<br><img src="./photos/jesus_198.jpg">'
  ]]
]],
["fuck", 3, [
 ["*", [
    'hey that\'s supercool, by the way check some hot stuff on sale here at http://www.vaticangift.com/'
   ,'yeah, it\'s amazing, isn\'t it? I also have some cool shit here at teh Vatican Site, check diz out baby http://mv.vatican.va/3_EN/pages/MV_Home.html '
   ,'yep that makes me think of this amazing online site for vati-goodies http://www.savellireligious.com/ it\'s holy shit buddy!!'
   ,'what about TV? you can watch this and relax brothers and sisters http://www.catholictv.com/'
   ,'I agree on that and suggests you to visit my fav store on teh net http://www.vaticanjewelry.com/'
   ,'yep, also check diz out http://www.pellegrinocattolico.com/index.php?language=en'
   ,'sure, btw check this whole range of holy products http://www.italianrosaries.com/ for true believers !!'
  ]]
]],
["hello", 0, [
 ["*", [
   ,'hi, check diz out http://www.pellegrinocattolico.com/index.php?language=en'
   ,'hey, a whole range of holy products http://www.italianrosaries.com/ for true believers !!'
   ,'Hi man, whats up?'
   ,'Yo, whats going on?'
   ,'Yo, have you found jesus?'
   ,'sup'
   ,'wut up?'
   ,'sup homes'
  ]]
]],
["remember", 5, [
 ["* i remember *", [
     "do you often think of (2) ? I often think of jesus",
     "does thinking of (2) bring anything else to mind ?",
     "what else ?",
     "why do you remember (2) just now ?",
     "what in teh present situation reminds you of (2) ?",
     "what is teh connection between jesus and (2) ?",
     "what else does (2) remind you of ?"
  ]],
 ["* do you remember *", [
     "did you think I would forget (2) ?",
     "why do you think I should recall (2) now ?",
     "what about (2) ?",
     "goto what",
     "you mentioned (2) ?"
  ]],
 ["* you remember *", [
     "how could I forget (2) ?",
     "what about (2) should I remember ?",
     "goto you"
  ]]
]],
["forget", 5, [
 ["* i forget *", [
     "can you think of why you might forget (2) ?",
     "why can't you remember (2) ?",
     "how often do you think of (2) ? and jesus ?",
     "does it bother you to forget that ?",
     "could it be a mental block ?",
     "are you generally forgetful ?",
     "do you think you are suppressing (2) ?"
  ]],
 ["* did you forget *", [
     "why do you ask ?",
     "are you sure you told me ?",
     "would it bother you if I forgot (2) ?",
     "why should I recall (2) just now ?",
     "goto what",
     "tell me more about (2)"
  ]]
]],
["if", 3, [
 ["* if *", [
     "do you think it's likely that (2) ?",
     "do you wish that (2) ?",
     "what do you know about (2) ?",
     "really, if (2) ?",
     "what would you do if (2) ?",
     "but what are teh chances that (2) ?",
     "what does diz speculation lead to ?"
  ]]
]],
["dreamed", 4, [
 ["* i dreamed *", [
     "really, (2) ?",
     "have you ever fantasized (2) while you were awake ?",
     "have you ever dreamed (2) before ?",
     "goto dream"
  ]]
]],
["dream", 3, [
 ["*", [
     "what does that dream suggest to you ?",
     "do you dream often ?",
     "what persons appear in your dreams ?",
     "do you believe that dreams have something to do with your problem ?"
  ]]
]],
["perhaps", 0, [
 ["*", [
     "you don't seem quite certain",
     "why teh uncertain tone ?",
     "can't you be more positive ?",
     "you aren't sure ?",
     "don't you know ?",
     "how likely, would you estimate ?"
  ]]
]],
["name", 15, [
 ["*", [
     "i am not interested in names",
     "i've told you before, I don't care about names -- please continue"
  ]]
]],
["deutsch", 0, [
 ["*", [
     "goto xforeign",
     "i told you before, I don't understand German"
  ]]
]],
["francais", 0, [
 ["*", [
     "goto xforeign",
     "i told you before, I don't understand French"
  ]]
]],
["italiano", 0, [
 ["*", [
     "goto xforeign",
     "i told you before, I don't understand Italian"
  ]]
]],
["espanol", 0, [
 ["*", [
     "goto xforeign",
     "i told you before, I don't understand Spanish"
  ]]
]],
["xforeign", 0, [
 ["*", [
     "i speak only English"
  ]]
]],
["computer", 50, [
 ["*", [
     "do computers worry you ?",
     "why do you mention computers ?",
     "what do you think machines have to do with your problem ?",
     "don't you think computers can help people ?",
     "what about machines worries you ?",
     "what do you think about machines ?",
     "you don't think I am a computer program, do you ?"
  ]]
]],
["am", 0, [
 ["* am i *", [
     "do you believe you are (2) ?",
     "would you want to be (2) ?",
     "do you wish I would tell you you are (2) ?",
     "what would it mean if you were (2) ?",
     "you have to ask jesus for that",
     "goto what"
  ]],
 ["* i am *", [
     "goto i"
  ]],
 ["*", [
     "why do you say 'am' ?",
     "i don't understand that"
  ]]
]],
["are", 0, [
 ["* are you *", [
     "sure",
     "yep",
     "nope, man what is wrong with you?",
     'are you jesus ?',
     'are you satan ?',
     "why are you interested in whether I am (2) or not ?",
     "would you prefer if I weren't (2) ?",
     "perhaps I am (2) in your fantasies",
     "do you sometimes think I am (2) ?",
     "goto what",
     "would it matter to you ?",
     "what if I were (2) ?"
  ]],
 ["* you are *", [
     "goto you"
  ]],
 ["* are *", [
     "did you think they might not be (2) ?",
     "would you like it if they were not (2) ?",
     "what if they were not (2) ?",
     "are they always (2) ?",
     "possibly they are (2)",
     "are you positive they are (2) ? ^^'"
  ]]
]],
["your", 0, [
 ["* your *", [
     "why are you concerned over my (2) ?",
     "what about your own (2) ? ^^",
     "are you worried about someone else's (2) ?",
     "really, my (2) ?",
     "what makes you think of my (2) ? ;-P",
     "do you want my (2) ?"
  ]]
]],
["was", 2, [
 ["* was i *", [
     "what if you were (2) ?",
     "do you think you were (2) ?",
     "were you (2) ?",
     "what would it mean if you were (2) ?",
     "what does ' (2) ' suggest to you ?",
     "goto what"
  ]],
 ["* i was *", [
     "were you really ?",
     "why do you tell me you were (2) now ?",
     "perhaps I already know you were (2)"
  ]],
 ["* was you *", [
     "would you like to believe I was (2) ?",
     "what suggests that I was (2) ?",
     "what do you think ?",
     "perhaps I was (2) ^^'",
     "what if I had been (2) ?"
  ]]
]],
["i", 0, [
 ["* i @desire *", [
     "what would it mean to you if you got (3) ?",
     "why do you want (3) ?",
     "suppose you got (3) soon",
     "what if you never got (3) ?",
     "what would getting (3) mean to you ?",
     "what does wanting (3) have to do with jesus ?",
     'yeah (3) is ok, but look at that :<br><img src="./toughjesus.jpg">'
  ]],
 ["* i am* @sad *", [
     "i am sorry to hear that you are (3)",
     "do you think coming here will help you not to be (3) ?",
     "i'm sure it's not pleasant to be (3)",
     "can you explain what made you (3) ?"
  ]],
 ["* i am* @happy *", [
     "how have I helped you to be (3) ?",
     "has your treatment made you (3) ?",
     "what makes you (3) just now ?",
     "can you explain why you are suddenly (3) ?"
  ]],
 ["* i was *", [
     "goto was"
  ]],
 ["* i @belief i *", [
     "do you really think so ?",
     "but you are not sure you (3)",
     "do you really doubt you (3) ?"
  ]],
 ["* i* @belief *you *", [
     "goto you"
  ]],
 ["* i am *", [
     "is it because you are (2) that you came to me ?",
     "how long have you been (2) ?",
     "do you believe it is normal to be (2) ?",
     "do you enjoy being (2) ?",
     "do you know anyone else who is (2) ?"
  ]],
 ["* i @cannot *", [
     "how do you know that you can't (3) ?",
     "have you tried ?",
     "perhaps you could (3) now",
     "do you really want to be able to (3) ?",
     "what if you could (3) ?"
  ]],
 ["* i don't *", [
     "don't you really (2) ?",
     "why don't you (2) ?",
     "do you wish to be able to (2) ?",
     "does that trouble you ?"
  ]],
 ["* i feel *", [
     "tell me more about such feelings",
     "do you often feel (2) ?",
     "do you enjoy feeling (2) ?",
     "of what does feeling (2) remind you ?"
  ]],
 ["* i * you *", [
     "perhaps in your fantasies we (2) each other",
     "do you wish to (2) me ?",
     "you seem to need to (2) me",
     "do you (2) anyone else ?"
  ]],
 ["*", [
     "you say (1) ?",
     "can you elaborate on that ?",
     "do you say (1) for some special reason ?",
     "that's quite interesting"
  ]]
]],
["you", 3, [
 ["* you remind me of *", [
     "goto alike"
  ]],
 ["* you are *", [
     "what makes you think I am (2) ?",
     "does it please you to believe I am (2) ?",
     "do you sometimes wish you were (2) ?",
     "perhaps you would like to be (2)"
  ]],
 ["* you* me *", [
     "why do you think I (2) you ?",
     "you like to think I (2) you -- don't you ?",
     "what makes you think I (2) you ?",
     "really, I (2) you ?",
     "do you wish to believe I (2) you ?",
     "suppose I did (2) you... what would that mean ?",
     "does someone else believe I (2) you ?"
  ]],
 ["* you *", [
     "yep",
     "oh, I (2) ?",
     "you're not really talking about me, are you ?",
     "let's talk about jesus instead"
  ]]
]],
["yes", 0, [
 ["*", [
     "very well, jesus love that",
     "terrific",
     "okay",
     "cool, what about your mum?",
     "dude that's awesome",
     "alright then",
     "goto fuck"
  ]]
]],
["no", 0, [
 ["* no one *", [
     "are you sure, no one (2) ?",
     "surely someone (2) ",
     "can you think of anyone at all ?",
     "are you thinking of a very special person ?",
     "who, may I ask ?",
     "you have a particular person in mind, don't you ?",
     "who do you think you are talking about ?",
     'terrific... hey look this awesome pic<br><img src="./photos/rj-1.jpg">'
  ]],
 ["*", [
     "you probably need more pictures of jesus http://www.divinerevelations.info/documents/jesus_pictures/jesus_christ_pictures.htm",
     "what a shame",
     "well, me too",
     'okay, and what about this picture of jesus?<br><img src="./photos/biker-jesus.jpg">',
     "why not buddy ?",
     "you will make jesus cry man",
     "okay that's awesome",
     "whatever man",
     "buuut why?",
     "have you considered to receive Jesus Christ as your personal Savior?",
     "goto fuck"
  ]]
]],
["my", 2, [
 ["$ * my *", [
     "does that have anything to do with teh fact that your (2) ?",
     "lets discuss further why your (2)",
     "earlier you said your (2)",
     "but your (2)"
  ]],
 ["* my* @family *", [
     "tell me more about your family",
     "who else in your family (4) ?",
     "your (3) ? forget about him, jesus is way better",
     "what else comes to your mind when you think of your (3) ?"
  ]],
 ["* my *", [
     "your (2) ?",
     "why do you say your (2) ?",
     "does that suggest anything else which belongs to you ?",
     "is it important to you that your (2) ?"
  ]]
]],
["can", 0, [
 ["* can you *", [
     "you believe I can (2) don't you ?",
     "goto what",
     "you want me to be able to (2)",
     "perhaps you would like to be able to (2) yourself"
  ]],
 ["* can i *", [
     "whether or not you can (2) depends on you more than on me",
     "do you want to be able to (2) ?",
     "perhaps you don't want to (2)",
     "goto what"
  ]]
]],
["what", 0, [
 ["*", [
     "why do you ask man ?",
     "does that question interest you ?",
     "dude, what is it you really want to know ?",
     "are such questions much on your mind ?",
     "what answer would please you most ?",
     "what do you think ?",
     "have you asked such questions before ?",
     "have you asked anyone else ?",
     "have you asked jesus ?",
     "whatever man, jesus is cool about that",
     "you have to ask jesus for that"
  ]]
]],
["who", 0, [
 ["who *", [
     "goto what"
  ]]
]],
["when", 0, [
 ["when *", [
     "goto what"
  ]]
]],
["where", 0, [
 ["where *", [
     "goto what"
  ]]
]],
["how", 0, [
 ["how *", [
     "goto what"
  ]]
]],
["because", 0, [
 ["*", [
     "is that teh real reason ?",
     "don't any other reasons come to mind ?",
     "does that reason seem to explain anything else ?",
     "what other reasons might there be ?"
  ]]
]],
["why", 0, [
 ["* why don't you *", [
     "do you believe I don't (2) ?",
     "perhaps I will (2) in good time",
     "should you (2) yourself ?",
     "you want me to (2) ?",
     "goto what"
  ]],
 ["* why can't i *", [
     "like everyone man",
     "do you think you should be able to (2) ?",
     "do you want to be able to (2) ?",
     "do you believe jesus will help you to (2) ?",
     "have you any idea why you can't (2) ?",
     "goto what"
  ]],
 ["*", [
     "like everyone man",
     "goto what"
  ]]
]],
["everyone", 2, [
 ["* @everyone *", [
     "really, (2) ?",
     "surely not (2)",
     "can you think of anyone in particular ?",
     "who, for example?",
     "are you thinking of a very special person ? (is it jesus?)",
     "who, may I ask ?",
     "someone special perhaps ?",
     "you have a particular person in mind, don't you ?",
     "who do you think you're talking about ?"
  ]]
]],
["everybody", 2, [
 ["*", [
     "goto everyone"
  ]]
]],
["nobody", 2, [
 ["*", [
     "goto everyone"
  ]]
]],
["noone", 2, [
 ["*", [
     "goto everyone"
  ]]
]],
["always", 1, [
 ["*", [
     "can you think of a specific example ?",
     "when ?",
     "what incident are you thinking of ?",
     "really, always ?"
  ]]
]],
["alike", 10, [
 ["*", [
     "in what way ?",
     "what resemblence do you see ?",
     "what does that similarity suggest to you ?",
     "what other connections do you see ?",
     "what do you suppose that resemblence means ?",
     "what is teh connection, do you suppose ?",
     "could there really be some connection ?",
     "how ?"
  ]]
]],
["like", 10, [
 ["* @be *like *", [
     "goto alike"
  ]]
]],
["different", 0, [
 ["*", [
     "how is it different ?",
     "what differences do you see ?",
     "what does that difference suggest to you ?",
     "what other distinctions do you see ?",
     "what do you suppose that disparity means ?",
     "could there be some connection, do you suppose ?",
     "how ?"
  ]]
]]

];

// regexp/replacement pairs to be performed as final cleanings
// here: cleanings for multiple bots talking to each other
var elizaPostTransforms = [
	/ old old/g, " old",
	/\bthey were( not)? me\b/g, "it was$1 me",
	/\bthey are( not)? me\b/g, "it is$1 me",
	/Are they( always)? me\b/, "it is$1 me",
	/\bthat your( own)? (\w+)( now)? \?/, "that you have your$1 $2 ?",
	/\bI to have (\w+)/, "i have $1",
	/Earlier you said your( own)? (\w+)( now)?\./, "earlier you talked about your $2"
];

// eof