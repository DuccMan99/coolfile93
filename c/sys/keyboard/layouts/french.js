/* French keyboard layouts
 * contains layout: french-azerty-1 and 'french-azerty-2'
 *
 * To use:
 *  Point to this js file into your page header: <script src="layouts/french.js" type="text/javascript"></script>
 *  Initialize the keyboard using: $('input').keyboard({ layout: 'french-azerty-1' });
 *
 * license for this file: WTFPL, unless the source layout site has a problem with me using them as a reference
 */

/* based on http://ascii-table.com/keyboard.php/189 & thanks to Nathana�l SEMHOUN: http://nathanael.semhoun.net */
le._keyboard.layout['french-azerty-1'] = {
	'name' : 'french-azerty-1',
	'lang' : ['fr'],
	'normal' : [
		"\u00b2 & \u00e9 \" ' ( - \u00e8 _ \u00e7 \u00e0 ) = {Backspace}",
		"{Tab} a z e r t y u i o p ^ $ {Enter}",
		"{CapsLock} q s d f g h j k l m \u00f9 * {Enter}",
		"{Shift} < w x c v b n , ; : ! {ShiftRight}",
		"{Control} {OS} {Alt} {Spacebar} {AltGraph} {ControlRight}"
	],
	'Shift' : [
		"\u00B2 1 2 3 4 5 6 7 8 9 0 \u00b0 + {Backspace}",
		"{Tab} A Z E R T Y U I O P \u00a8 \u00a3 {Enter}",
		"{CapsLock} Q S D F G H J K L M % \u00b5 {Enter}",
		"{Shift} > W X C V B N ? . / \u00a7 {ShiftRight}",
		"{Control} {OS} {Alt} {Spacebar} {AltGraph} {ControlRight}"
	],
	'AltGraph' : [
		"\u00b2 & ~ # { [ | ` \\ ^ @ ] } {Backspace}",
		"{Tab} a z \u20ac r t y u i o p ^ \u00a4 {Enter}",
		"{CapsLock} q s d f g h j k l m \u00f9 * {Enter}",
		"{Shift} < w x c v b n , ; : ! {ShiftRight}",
		"{Control} {OS} {Alt} {Spacebar} {AltGraph} {ControlRight}"
	],
	'Shift_AltGraph' : [
		"\u00B2 1 ~ # { [ | ` \\ ^ @ ] } {Backspace}",
		"{Tab} A Z \u20ac R T Y U I O P \u00a8 \u00a4 {Enter}",
		"{CapsLock} Q S D F G H J K L M % \u00b5 {Enter}",
		"{Shift} > W X C V B N ? . / \u00a7 {ShiftRight}",
		"{Control} {OS} {Alt} {Spacebar} {AltGraph} {ControlRight}"
	],
};

le._keyboard.layout['french-azerty-2'] = {
	'name' : 'french-azerty-2',
	'lang' : ['fr'],
	'normal' : [
		"\u00b2 & \u00e9 \" ' ( - \u00e8 _ \u00e7 \u00e0 ) = {b}",
		"{t} a z e r t y u i o p ^ $",
		"{CapsLock} q s d f g h j k l m  \u00f9 * {e}",
		"{s} < w x c v b n , ; : ! {s}",
		"{a} {Alt} {Spacebar} {Alt} {c}"
	],
	'shift' : [
		"{sp:1} 1 2 3 4 5 6 7 8 9 0 \u00b0 + {b}",
		"{t} A Z E R T Y U I O P \u00a8 \u00a3",
		"{CapsLock} Q S D F G H J K L M % \u00b5 {e}",
		"{s} > W X C V B N ? . / \u00a7 {s}",
		"{a} {Alt} {Spacebar} {Alt} {c}"
	],
	'alt' : [
		"\u00b2 & ~ # { [ | ` \\ ^ @ ] } {b}",
		"{t} a z \u20ac r t y u i o p ^ \u00a4",
		"{CapsLock} q s d f g h j k l m  \u00f9 * {e}",
		"{s} < w x c v b n , ; : ! {s}",
		"{a} {Alt} {Spacebar} {Alt} {c}"
	],
	'alt-shift' : [
		"{sp:1} 1 ~ # { [ | ` \\ ^ @ ] } {b}",
		"{t} A Z \u20ac R T Y U I O P \u00a8 \u00a4",
		"{CapsLock} Q S D F G H J K L M % \u00b5 {e}",
		"{s} > W X C V B N ? . / \u00a7 {s}",
		"{a} {Alt} {Spacebar} {Alt} {c}"
	],
};

le._keyboard.layout['french-bepo-V1.0rc2'] = {
	'name' : 'french-bepo-V1.0rc2',
	'lang' : ['fr'],
	'normal' : [
		"$ \" \u00AB \u00BB ( ) @ + - / * = % {b}",
		"{t} b \u00e9 p o \u00e8 \u02c6 v d l j z w",
		"a u i e , c t s r n m \u00E7 {Enter}",
		"{s} \u00ea \u00E0 y x . k \' q g h f {s}",
		"{a} {Alt} {Spacebar} {Alt} {c}"
	],
	'shift' : [
		"# 1 2 3 4 5 6 7 8 9 0 \u00b0 ` {b}",
		"{t} B \u00c9 P O \u00c8 ! V D L J Z W",
		"A U I E ; C T S R N M \u00c7 {Enter}",
		"{s} \u00ca \u00c0 Y X : K ? Q G H F {s}",
		"{a} {Alt} {Spacebar} {Alt} {c}"
	],
	'alt' : [
		"\u2013 \u2014 < > [ ] ^ \u00b1 \u2212 \u00f7 \u00d7 \u2260 \u2030 {b}",
		"{t} | \u00b4 & \u0153 ` \u00a1 \u02c7 \u00f0 / \u0133 \u0259 \u02d8",
		"\u00e6 \u00f9 \u00a8 \u20ac \u2019 \u00a9 \u00fe \u00df \u00ae ~ \u00af \u00b8 {Enter}",
		"{s} / \\ { } \u2026 ~ \u00bf \u00b0 \u00b5 \u2020 \u02db {s}",
		"{a} {Alt} {Spacebar} {Alt} {c}"
	],
	'alt-shift' : [
		"\u00b6 \u201e \u201c \u201d \u2264 \u2265 {empty} \u00ac \u00bc \u00bd \u00be \u2032 \u2033 {b}",
		"{t} \u00A6 \u02DD \u00A7 \u0152 ` \u00A1 {empty} \u00D0 {empty} \u0132 \u018F \u02d8",
		"\u00c6 \u00d9 \u02d9 \u00a4 \u031b \u017f \u00de \u1e9e \u2122 {empty} \u00ba , {Enter}",
		"{s} {empty} {empty} \u2018 \u2019 \u00B7 {empty} \u0309 \u0323 {empty} \u2021 \u00AA {s}",
		"{a} {Alt} {Spacebar} {Alt} {c}"
	]
};
