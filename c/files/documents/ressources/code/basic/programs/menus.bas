100 rem simple menu test for Chipmunk Basic (MacOS version)
110 '	menu items strings
120 m$ = "test 1;-;test 3;test 4/T;test 5"
130 '	menu commands to execute
140 domenu$ = "foo(1);;foo(3);foo(4);foo5()"
160 '	menu 4 and menu title
180 call "menu",4,"appMenu",m$,domenu$
200 '	wait for the user to select something
220 while inkey$ = ""
240   doevents ()
260 wend
280 end
300 '	subroutines for domenu$
400 sub foo(x)
420   print "you selected menu item ";x, (menuitem mod 256)
440 end sub
500 sub foo5()
520   print "you selected menu item ";5
540 end sub
990 end

