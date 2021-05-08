
100 rem modified for Chipmunk Basic  96-feb-13  rhn
110 rem From: whirata@pixi.com (Wayne R Hirata) Newsgroups: comp.lang.basic.misc
120 rem Subject: Re: Old 1976 Star Trek in BASIC (no graphics)
130 rem Date: Sun, 17 Sep 1995 08:11:44 GMT
140 rem
150 rem  *** SUPER STAR TREK ***
160 rem   INTELLEC MDS VERSION
170 rem WRITTEN IN BASIC BY RON WILLIAMS
180 rem   INTEL CORP. - 5/15/76
190 rem ADAPTED FROM A FORTRAN VERSION WRITTEN
200 rem   FOR THE CDC 6600 IN 1974.
210 rem
220 dim g1$(16),v$(5,5),c$(20),g(8,8),d$(12),q$(10,10),d4(12),d9(106)
230 dim s2(8,8),t$(10),s$(10),c2$(10),c5(10),g1(10),f1(10),k4(10),k5(10)
240 dim k6(10),k7(10),k8(10),s7$(10),c1(10),c2(10),b2(10),b3(10) : q$ = "?"
250 data "S.R. SENSORS","L.R. SENSORS","PHASERS","PHOTON TUBES","LIFE SUPPORT"
260 data "WARP ENGINES","IMPULSE ENGINES","SHIELDS","SUBSPACE RADIO"
270 data "SHUTTLE CRAFT","COMPUTER","TRANSFER PANEL","ABANDON","CHART","COMPUTER"
280 data "DAMAGES","DESTRUCT","DOCK","IDLE","IMPULSE","LRSCAN","NAVIGATE","PHASERS","QUIT"
290 data "SHIELDS","SOS","SRSCAN","STATUS","TORPEDO","TRANSFER","VISUAL","WARP","SHORT"
300 data "MEDIUM","LONG","BEGINNER","NOVICE","SENIOR","EXPERT","COURSE","WCOST","ICOST"
310 data "PEFFECT","SCORE","END","ANTARES","SIRIUS","RIGEL","MERAK","PROCYON","CAPELLA"
320 data "VEGA","DENEB","CANOPUS","ALDEBARAN","ALTAIR","REGULUS","BELLATRIX","ARCTURUS"
330 data "POLLUX","SPICA",10.5,12,1.5,9,0,3,7.5,6,4.5
340 def fna(X)=INT(8*RND(X))+1:DEF FNB(X)=INT(10*RND(X))+1
350 def fnd(X)=X/60
360 def fnr(X)=INT(X*10+.5)/10:DEF FNS(X)=INT(X*100+.5)/100
370 gosub 16340
380 for i = 1 to 12 : read d$(i) : next : for i = 1 to 20 : read c$(i) : next
390 for i = 1 to 3 : read t$(i) : next : for i = 1 to 4 : read s$(i) : next : for i = 1 to 6
400 read c2$(i) : next : for i = 1 to 16 : read g1$(i) : next : for i = 1 to 9 : read c5(i) : next
410 rem CALL SETUP
420 gosub 12470 : s7$(1) = "" : s7$(2) = " " : s7$(3) = " " : s7$(4) = ""
430 if a2 <> 0 then 1470
440 j4 = 0 : t1 = 0 : print : input "COMMAND ";a$ : if len(a$) > 1 then 460
450 print "USE AT LEAST 2 LETTERS, PLEASE." : goto 440
460 for i = 1 to 20
470 if a$ = left$(c$(i),len(a$)) then 540
480 next
490 input "ILLEGAL COMMAND - DO YOU NEED A LIST ";b$
500 if left$(b$,1) = "N" then 430
510 print : for i = 1 to 20 step 4
520 print c$(i);tab (12);c$(i+1);tab (22);c$(i+2);tab (32);c$(i+3)
530 next : print : goto 430
540 if i < 11 then on i goto 580,610,640,670,700,720,750,820,860,890
550 on i-10 goto 930,980,1020,1090,1120,1150,1180,1220,1280,1340
560 print "ERROR AT 170 - SHOULD NOT BE HERE"
570 stop
580 rem-ABANDON
590 gosub 15830
600 goto 430
610 rem-CHART
620 gosub 2880
630 goto 430
640 rem-COMPUTER
650 gosub 3530
660 goto 430
670 rem-DAMAGES
680 gosub 4630
690 goto 430
700 rem - DESTRUCT
710 gosub 16080 : goto 430
720 rem-DOCK
730 gosub 4510
740 goto 430
750 rem-IOLE
760 gosub 15190
770 if j3 = 0 then 430
780 if a2 <> 0 then 1470
790 if g(q1,q2) = 1000 then 1420
800 gosub 1520
810 goto 430
820 rem-IMPULSE
830 gosub 7500
840 if j3 = 0 then 430
850 goto 1370
860 rem-LRSCAN
870 gosub 7780
880 goto 430
890 rem-NAVIGATE
900 gosub 15340
910 if j3 = 0 then 430
920 goto 1370
930 rem-PHASERS
940 gosub 10560
950 if j3 = 0 then 430
960 gosub 1520
970 goto 430
980 rem-QUIT
990 goto 1470
1000 print "TO O BAD...WE HATE TO LOSE GOOD ASTRONAUTS!"
1010 goto 16330
1020 rem-SHIELDS
1030 gosub 13250
1040 if j3 = 0 then 430
1050 if a2 <> 0 then 1470
1060 gosub 1520
1070 s9 = 0
1080 goto 430
1090 rem-SOS
1100 gosub 6800
1110 goto 430
1120 rem-SRSCAN
1130 gosub 14010
1140 goto 430
1150 rem - STATUS
1160 print
1170 gosub 16310 : goto 430
1180 rem-TORPEDOS
1190 gosub 10970
1200 if j3 = 0 then 430
1210 goto 1370
1220 rem-TRANSFER
1230 gosub 14510
1240 if j3 = 0 then 430
1250 if a2 <> 0 then 1470
1260 if g(q1,q2) <> 1000 then 430
1270 goto 1420
1280 rem-VISUAL
1290 gosub 14670
1300 if j3 = 0 then 430
1310 if a2 <> 0 then 1470
1320 if g(q1,q2) <> 1000 then 430
1330 goto 1420
1340 rem-WARP
1350 gosub 13050
1360 goto 430
1370 rem-AFTERMOVINGSTARSHIP
1380 if a2 <> 0 then 1470
1390 if t1 <> 0 then gosub 4760
1400 if a2 <> 0 then 1470
1410 if g(q1,q2) < 1000 then 1450
1420 gosub 2380
1430 if a2 <> 0 then 1470
1440 goto 1410
1450 gosub 1520
1460 goto 430
1470 rem-WE'RE FINISHED
1480 print : print : input "WOULD YOU LIKE TO TRY AGAIN ";a$
1490 if left$(a$,1) = "Y" then 410
1500 goto 1000
1510 rem-BEGINSUBROUTINES
1520 rem-ATTACK
1530 if (c3 <> 0) and (j4 = 0) then gosub 8830
1540 if k3 = 0 then return
1550 if a2 <> 0 then return
1560 p2 = 1/i8
1570 j5 = 0
1580 print
1590 if c5$ = "DOCKED" then 2310
1600 h2 = 0 : h3 = 0 : c6 = 1
1610 if s9 = 1 then c6 = 0.5+0.5*rnd(1)
1620 a3 = 0
1630 for l = 1 to k3
1640 if k6(l) < 0 then 2070
1650 a3 = 1
1660 d6 = 0.8+0.05*rnd(1)
1670 h4 = k6(l)*d6^k8(l)
1680 if (s4 = 0) and (s9 = 0) then 1750
1690 p3 = 0.1 : if p2*s3 > p3 then p3 = p2*s3
1700 h5 = p3*c6*h4+1
1710 if h5 > s3 then h5 = s3
1720 s3 = s3-h5
1730 h4 = h4-h5
1740 if (p3 > 0.1) and (h4 < 5.000000E-03*e1) then 2070
1750 j5 = 1
1760 print fnr(h4);"UNIT HIT ON THE ";s5$;" FROM ";
1770 j6 = k4(l) : j7 = k5(l)
1780 if q$(j6,j7) = "K" then print "KLINGON AT ";
1790 if q$(j6,j7) = "C" then print "COMMANDER AT ";
1800 print j6;"-";j7
1810 if h4 > h2 then h2 = h4
1820 h3 = h3+h4
1830 if h4 < (275-25*s8)*(1+0.5*rnd(1)) then 2060
1840 n4 = 1+int(h4/(500+100*rnd(1)))
1850 print "***CRITICAL HIT--";
1860 k9 = 1
1870 for w4 = 1 to n4
1880 j9 = int(12*rnd(1))+1
1890 c5(w4) = j9
1900 e3 = (h4*d5)/(n4*(75+25*rnd(1)))
1910 if j9 = 6 then e3 = e3/3
1920 d4(j9) = d4(j9)+e3
1930 if w4 = 1 then 2000
1940 for v = 1 to w4
1950 if j9 = c5(v-1) then 2010
1960 next v
1970 k9 = k9+1
1980 if k9 = 3 then print
1990 print " AND ";
2000 print d$(j9);
2010 next w4
2020 print " DAMAGED."
2030 if d4(8) = 0 then 2060
2040 if s4 <> 0 then print "*** SHIELDS KNOCKED DOWN."
2050 s4 = 0
2060 e1 = e1-h4
2070 next l
2080 if a3 = 0 then return
2090 if e1 <= 0 then 2280
2100 p4 = 100*p2*s3+0.5
2110 if j5 <> 0 then 2140
2120 print "KLINGONS ATTACK--SHIELD STRENGTH REDUCED TO ";
2130 goto 2180
2140 print "ENERGY LEFT:";fns(e1);"  SHIELDS ";
2150 if s4 <> 0 then print "UP,";
2160 if (s4 = 0) and (d4(8) = 0) then print "DOWN, ";
2170 if d4(8) > 0 then print "DAMAGED, ";
2180 print int(p4);"%"
2190 if (h2 < 200) and (h3 < 500) then 2330
2200 j8 = int(h3*rnd(1)*0.015)
2210 if j8 < 2 then 2330
2220 print
2230 print "MCCOY - 'SICKBAY TO BRIDGE. WE SUFFERED ";
2240 print j8;"CASUALTIES"
2250 print "     IN THAT LAST ATTACK'"
2260 c4 = c4+j8
2270 goto 2330
2280 f9 = 5
2290 gosub 5940
2300 return
2310 print "*** KLINGONS ATTACK-- STARBASE SHIELDS PROTECT ";
2320 print "THE ";s5$
2330 for w4 = 1 to k3
2340 k8(w4) = k7(w4)
2350 next w4
2360 gosub 13880
2370 return
2380 rem-AUTO VER
2390 print
2400 if j4 = 0 then 2440
2410 print "*** RED ALERT! RED ALERT!"
2420 print "***THE ";s5$;" HAS STOPPED IN A QUADRANT ";
2430 print "CONTAINING A SUPERNOVA."
2440 print "*** EMERGENCY AUTO -OVERRIDE ATTEMPTS TO HURL ";
2450 print s5$
2460 print "  SAFELY OUT OF THE QUADRANT."
2470 s2(q1,q2) = 1
2480 gosub 9500
2490 if d4(6) = 0 then 2690
2500 print
2510 print "WARP ENGINES DAMAGED."
2520 print
2530 print "ATTEMPTING TO ENGAGE IMPULSE ENGINES..."
2540 if d4(7) = 0 then 2590
2550 print "IMPULSE ENGINES DAMAGED."
2560 f9 = 8
2570 gosub 5940
2580 return
2590 p2 = 0.75*e1
2600 d6 = 4.000000E-03*(p2-50)
2610 d7 = 1.4142+1.2*rnd(1)
2620 d1 = d6
2630 if d6 > d7 then d1 = d7
2640 t1 = d1/0.4
2650 d2 = 12*rnd(1)
2660 j4 = 0
2670 gosub 7720
2680 goto 2800
2690 w1 = 6+2*rnd(1)
2700 w2 = w1*w1
2710 p2 = 0.75*e1
2720 d6 = p2/(w1*w1*w1*(s4+1))
2730 d7 = 1.4142+2*rnd(1)
2740 d1 = d6
2750 if d6 > d7 then d1 = d7
2760 t1 = 10*d1/w2
2770 d2 = 12*rnd(1)
2780 j4 = 0
2790 gosub 15560
2800 if j4 <> 0 then 2840
2810 f9 = 8
2820 gosub 5940
2830 return
2840 if r1 <> 0 then return
2850 f9 = 1
2860 gosub 5940
2870 return
2880 rem-CHART
2890 print : print "   1  2  3  4  5  6  7  8"
2900 print "   --- --- --- --- --- --- --- ---"
2910 for i = 1 to 8
2920 print i;" ";
2930 for j = 1 to 8
2940 on sgn(s2(i,j))+2 goto 2960,2980,3000
2950 print "ERR AT 3065" : sto p
2960 print " .1.";
2970 goto 3050
2980 print " ...";
2990 goto 3050
3000 if s2(i,j) > 1000 then 3040
3010 if g(i,j) < 1000 then print s7$(len(str$(g(i,j))));str$(g(i,j));
3020 if g(i,j) = 1000 then print " ***";
3030 goto 3050
3040 print s2(i,j)-1000;
3050 next j
3060 print
3070 next i : gosub 9830
3080 print
3090 print "THE ";s5$;" IS CURRENTLY IN ";g2$;" (";q1;"-";q2;")"
3100 return
3110 rem-CHOOSE
3120 for i = 1 to 10 : print : next : for i = 1 to 41 : print "*"; : next : print
3130 print "**";tab (39);"**"
3140 print "** WELCOME TO THE WORLD OF STAR TREK **"
3150 print "**";tab (39);"**" : for i = 1 to 41 : print "*"; : next : print
3160 print : print
3170 s8 = 0 : l2 = 0
3180 print "HOW LONG A GAME WOULD YOU LIKE ";
3190 input a$
3200 for i = 1 to 3
3210 if a$ = left$(t$(i),len(a$)) then 3250
3220 next i
3230 print "WOULD YOU LIKE A SHORT, MEDIUM OR LONG GAME ";
3240 goto 3190
3250 l2 = i
3260 print "ARE YOU A BEGINNER, NOVICE, SENIOR OR EXPERT PLAYER ";
3270 input a$
3280 for i = 1 to 4
3290 if a$ = left$(s$(i),len(a$)) then 3320
3300 next i
3310 goto 3260
3320 s8 = i
3330 input "ENTER YOUR MISSION PASSWORD... ";x$
3340 print
3350 print "....SETTING UP THE GALAXY...."
3360 j = rnd(1)
3370 rem-INITIALIZE
3380 d5 = 0.5*s8
3390 i2 = int(l2+1+rnd(1)*3)
3400 if i2 > 5 then i2 = 5
3410 r3 = i2
3420 i5 = 7*l2
3430 r5 = i5
3440 r7 = (s8-2*rnd(1)+1)*s8*0.1+0.1
3450 if r7 < 0.2 then r7 = r7+0.1
3460 i1 = int(2*r7*i5)
3470 r1 = i1
3480 i4 = int(s8+0.0625*i1*rnd(1))
3490 r2 = i4
3500 i3 = (i1+4*i4)*i5
3510 r4 = i3
3520 return
3530 rem-COMPUTE
3540 if d4(11) = 0 then 3570
3550 print "LIBRARY COMPUTER DISABLED"
3560 return
3570 print "----LIBRARY COMPUTER ACTIVE----"
3580 input "PROGRAM NAME ";b$
3590 for i = 1 to 6
3600 if b$ = left$(c2$(i),len(b$)) then 3660
3610 next
3620 print "VALID PROGRAMS ARE:"
3630 print " COURSE  WCOST  ICOST"
3640 print " PEFFECT  SCORE  END"
3650 goto 3580
3660 on i goto 3670,3920,4000,4070,4130,4160
3670 rem-COURSE&DIRECTION
3680 input "ENTER QUADRANT AND SECTOR - ";a3,a4
3690 if (a3 <> int(a3)) or (a4 <> int(a4)) then 4170
3700 if a3 < 0 then 3580
3710 if a3 = 0 then a3 = 10*q1+q2
3720 a3 = a3+0.5
3730 k = int(a3/10)
3740 if (k < 1) or (k > 8) then 4170
3750 c6(1) = k : k = int(a3-c6(1)*10)
3760 if (k < 1) or (k > 8) then 4170
3770 c6(2) = k : a4 = a4+0.5
3780 k = int(a4/100)
3790 if (k < 1) or (k > 10) then 4170
3800 c6(1) = c6(1)+(k-1)/10 : k = int(a4-k*100)
3810 if (k < 1) or (k > 10) then 4170
3820 c6(2) = c6(2)+(k-1)/10
3830 x = q1+((s6-1)/10)-c6(1) : y = q2+((s7-1)/10)-c6(2)
3840 d1 = 0 : d2 = 0 : if (x = 0) and (y = 0) then 3900
3850 d1 = sqr(x*x+y*y)
3860 if x < 0 then z7 = sgn(y)*(3.1416-arctan(abs(y/x)))
3870 if x = 0 then z7 = sgn(y)*1.5708
3880 if x > 0 then z7 = arctan(y/x)
3890 d2 = 12-z7*1.909859 : if d2 > 12 then d2 = d2-12
3900 print "COURSE IS ";fns(d2);" FOR A DISTANCE OF ";
3910 print fns(d1);"QUADRANTS." : goto 3580
3920 rem-COST FOR WARP DRIVE
3930 input "ENTER DISTANCE AND WARP FACTOR ";d1,a4
3940 if (d1 < 0) then 3580
3950 c7 = d1*a4*a4*a4
3960 t1 = (10*d1)/(a4*a4)
3970 print "IT WOULD TAKE ";fns(t1);"STARDATES AND USE"
3980 print fnr(c7);"UNITS OF ENERGY (";fnr(c7+c7);" IF SHIELDS ARE UP)"
3990 goto 3580
4000 rem-COST FOR IMPULSE POWER
4010 input "ENTER DISTANCE... ";d1
4020 if d1 < 0 then 3580
4030 c7 = 250*d1+50 : t1 = d1/0.4
4040 print "IT WOULD TAKE ";fnr(t1);"STARDATES AND USE"
4050 print c7;"UNITS OF ENERGY"
4060 goto 3580
4070 rem-PHASER EFFECTIVENESS
4080 input "ENTER PHASER RANGE IN QUADRANTS ";a3
4090 if a3 < 0 then 3580
4100 a3 = a3*10 : c7 = (0.9^a3)*100
4110 print "PHASERS ARE ";left$(str$(c7),5);"% EFFECTIVE AT THAT RANGE"
4120 goto 3580
4130 rem- SCORE
4140 gosub 12110
4150 goto 3580
4160 return
4170 print " FORMAT IS MN,XXYY...WHERE MN IS THE QUADRANT"
4180 print "AND XXYY IS THE SECTOR...E.G. 64,0307 REFERS"
4190 print "TO QUADRANT 6-4, SECTOR 3-7."
4200 print "NOTE: SECTOR COORDINATES MUST BE 4 DIGITS."
4210 goto 3580
4220 rem - DEADKL
4230 if t2$ <> "C" then 4330
4240 c3 = 0 : print "***COMMANDER AT ";
4250 for f = 1 to r2
4260 if (c1(f) = q1) and (c2(f) = q2) then 4280
4270 next f
4280 c1(f) = c1(r2) : c2(f) = c2(r2) : c1(r2) = 0 : c2(r2) = 0
4290 r2 = r2-1 : f1(2) = 1.000000E+30
4300 if r2 <> 0 then f1(2) = d0-(i4/r2)*log(rnd(1))
4310 k2 = k2+1
4320 goto 4350
4330 print "***KLINGON AT ";
4340 k1 = k1+1
4350 print a5;"-";a6;"DESTROYED."
4360 q$(a5,a6) = "." : r1 = r1-1
4370 if r1 = 0 then return
4380 r5 = r4/(r1+4*r2)
4390 g(q1,q2) = g(q1,q2)-100
4400 for f = 1 to k3
4410 if (k4(f) = a5) and (k5(f) = a6) then 4430
4420 next f
4430 k3 = k3-1
4440 if f > k3 then 4490
4450 for g = fto k3
4460 k4(g) = k4(g+1) : k5(g) = k5(g+1) : k6(g) = k6(g+1)
4470 k7(g) = k7(g+1) : k8(g) = k7(g)
4480 next g
4490 k4(k3+1) = 0 : k5(k3+1) = 0 : k7(k3+1) = 0 : k8(k3+1) = 0 : k6(k3+1) = 0
4500 return
4510 rem-DOCK
4520 if c5$ = "DOCKED" then 4610
4530 if b6 = 0 then 4550
4540 if (abs(s6-b6) <= 1) and (abs(s7-b7) <= 1) then 4570
4550 print s5$;" NOT ADJACENT TO A BASE."
4560 return
4570 c5$ = "DOCKED"
4580 print "HELMSMAN SULU - 'DOCKING MANEUVER COMPLETED.'"
4590 e1 = i7 : s3 = i8 : t4 = i9 : l1 = j1
4600 return
4610 print "MR. SULU - 'BUT CAPTAIN, WE'RE AL READ Y DOCKED!'"
4620 return
4630 rem-DREPORT
4640 j = 0
4650 print
4660 for i = 1 to 12
4670 if d4(i) <= 0 then 4730
4680 if j <> 0 then 4720
4690 print "   DEVICE ";spc$(12);"-REPAIR TIMES-"
4700 print spc$(21);"IN FLIGHT  DOCKED"
4710 j = 1
4720 print " ";d$(i);tab (23);fns(d4(i));tab (33);fns(d3*d4(i))
4730 next i
4740 if j = 0 then print "MR. SPOCK - 'ALL DEVICES FUNCTIONAL, CAPTAIN'"
4750 return
4760 rem-EVENTS
4770 m = 0 : d7 = d0+t1
4780 for l = 1 to 5
4790 if f1(l) > d7 then 4810
4800 m = l : d7 = f1(l)
4810 next l
4820 x6 = d7-d0 : d0 = d7
4830 r4 = r4-(r1+4*r2)*x6
4840 r5 = r4/(r1+4*r2)
4850 if r5 > 0 then 4890
4860 f9 = 2
4870 gosub 5940
4880 return
4890 if (d4(5) = 0) or (c5$ = "DOCKED") then 4950
4900 if (l1 >= x6) or (d4(5) <= l1) then 4930
4910 f9 = 3 : gosub 5940
4920 return
4930 l1 = l1-x6
4940 if d4(5) <= x6 then l1 = j1
4950 r = x6
4960 if c5$ = "DOCKED" then r = x6/d3
4970 for l = 1 to 12
4980 if d4(l) <= 0 then 5030
4990 d4(l) = d4(l)-r
5000 if d4(l) < 0 then d4(l) = 0
5010 if d4(l) <> 0 then 5030
5020 print : print "DAMAGE CONTROL- '";d$(l);" NOW OPERATIONAL.'"
5030 next l
5040 if m = 0 then return
5050 t1 = t1-x6
5060 on m goto 5070,5120,5350,5440,5650
5070 rem-SUPERNOVA
5080 x2 = 0 : y2 = 0 : gosub 13410
5090 f1(1) = d0-0.5*i5*log(rnd(1))
5100 if g(q1,q2) = 1000 then return
5110 goto 4770
5120 rem-TRACTOR BEAM
5130 if r2 = 0 then 5340
5140 if c5$ = "DOCKED" then 5320
5150 i = int(rnd(1)*r2)+1
5160 y6 = (c1(i)-q1)^2+(c2(i)-q2)^2
5170 if y6 = 0 then 5320
5180 y6 = sqr(y6) : t1 = 0.17778*y6
5190 print : print "***";s5$;" CAUGHT IN LONG-RANGE TRACTOR BEAM--"
5200 q1 = c1(i) : q2 = c2(i)
5210 s6 = fnb(1) : s7 = fnb(1)
5220 print "  PULLED TO QUADRANT ";q1;"-";q2;", SECTOR ";s6;"-";s7
5230 if r6 <> 0 then print "(REMAINDER OF IDLE PERIOD CANCELLED)"
5240 r6 = 0
5250 if s4 <> 0 then 5310
5260 if (d4(8) = 0) and (s3 > 0) then 5290
5270 print "(SHIELDS NOT CURRENTLY USABLE.)"
5280 goto 5310
5290 gosub 13280
5300 s9 = 0
5310 gosub 9500
5320 f1(2) = d0+t1-1.5*(i5/r2)*log(rnd(1))
5330 goto 4770
5340 f1(2) = 1.000000E+30 : goto 4770
5350 d9(1) = d0 : d9(2) = r1 : d9(3) = r2 : d9(4) = r3 : d9(5) = r4 : d9(6) = r5
5360 d9(7) = s1 : d9(8) = b1 : d9(9) = k1 : d9(10) = k2
5370 for i = 1 to 8 : for j = 1 to 8 : d9(i-1+8*(j-1)+11) = g(i,j) : next j : next i
5380 for i = 75 to 84 : d9(i) = c1(i-74) : next
5390 for i = 85 to 94 : d9(i) = c2(i-84) : next
5400 for i = 95 to 99 : d9(i) = b2(i-94) : next
5410 for i = 100 to 104 : d9(i) = b3(i-99) : next
5420 d9(105) = b4 : d9(106) = b5
5430 s0 = 1 : f1(3) = d0-0.3*i5*log(rnd(1)) : goto 4770
5440 rem - STARBASE ATTACK
5450 if (r2 = 0) or (r3 = 0) then 5500
5460 for i = 1 to r3 : for j = 1 to r2 : if (b2(i) = c1(j)) and (b3(i) = c2(j)) then 5510
5470 next j : next i
5480 f1(4) = d0+0.5+3*rnd(1)
5490 f1(5) = 1.000000E+30 : goto 4770
5500 f1(4) = 1.000000E+30 : f1(5) = 1.000000E+30 : goto 4770
5510 b4 = b2(i) : b5 = b3(i)
5520 if (b4 = q1) and (b5 = q2) then 5480
5530 f1(5) = d0+0.5+3*rnd(1)
5540 f1(4) = f1(5)-0.3*i5*log(rnd(1))
5550 if d4(9) > 0 then 4770
5560 print
5570 print "LT. UHURA- 'CAPTAIN, THE STARBASE IN ";b4;"-";b5
5580 print " REPORTS THAT IT IS UNDER ATTACK AND CAN HOLD OUT"
5590 print " ONLY UNTIL STARDATE ";fnr(f1(5));"'"
5600 if r6 = 0 then 4770
5610 print
5620 input "MR. SPOCK- 'CAPTAIN, SHALL WE CANCEL THE IDLE PERIOD ";b$
5630 if left$(b$,1) = "Y" then r6 = 0
5640 goto 4770
5650 rem - STARBASE DESTROYED
5660 f1(5) = 1.000000E+30 : if (r2 = 0) or (r3 = 0) then 4770
5670 k = int(g(b4,b5)/100) : if g(b4,b5)-k*100 < 10 then 4770
5680 for i = 1 to r2 : if (c1(i) = b4) and (c2(i) = b5) then 5700
5690 next : goto 4770
5700 if s2(b4,b5) = -1 then s2(b4,b5) = 0
5710 if s2(b4,b5) > 999 then s2(b4,b5) = s2(b4,b5)-10
5720 if (b4 <> q1) or (b5 <> q2) then 5820
5730 for i = 1 to k3 : k = k4(i) : l = k5(i)
5740 if q$(k,l) = "C" then 5760
5750 next
5760 if k6(i) < 25+50*rnd(1) then 4770
5770 q$(b6,b7) = "." : b6 = 0 : b7 = 0
5780 gosub 9450
5790 print : print "MR. SPOCK- 'CAPTAIN, I BELIEVE THE STARBASE HAS ";
5800 print " BEEN DESTROYED.'"
5810 goto 5870
5820 if (r3 = 1) or (d4(9) > 0) then 5870
5830 print
5840 print "LT. UHURA- 'CAPTAIN, STARFLEET COMMAND REPORTS THAT"
5850 print " THE STARBASE IN QUADRANT ";b4;"-";b5;"HAS BEEN"
5860 print " DESTROYED BY A KLINGON COMMANDER.'"
5870 g(b4,b5) = g(b4,b5)-10
5880 if r3 <= 1 then 5920
5890 for i = 1 to r3 : if (b2(i) = b4) and (b3(i) = b5) then 5910
5900 next
5910 b2(i) = b2(r3) : b3(i) = b3(r3)
5920 r3 = r3-1
5930 goto 4770
5940 rem-FINISH
5950 a2 = 1 : print : print "IT IS STARDATE ";fnr(d0) : print
5960 if f9 <= 8 then on f9 goto 5980,6210,6300,6360,6380,6410,6420,6450
5970 on f9-8 goto 6480,6540,6570
5980 rem-THE GAME HAS BEEN WON
5990 print "YOU HAVE DESTROYED THE KLINGON INVASION FLEET"
6000 print
6010 print "   ***THE FEDERATION IS SAVED***" : g1 = 1
6020 if (a1 = 0) or (b1 <> 0) then 6190
6030 if left$(s5$,1) <> "E" then 6190
6040 if 3*s1+35*n1+c4 >= 100 then 6190
6050 if d0-j2 <= 6 then 6080
6060 r8 = 0.1*s8*(s8+1)+0.1
6070 if (k1+k2)/(d0-j2) < r8 then 6190
6080 print
6090 print "IN FACT, YOU HAVE DONE SO WELL THAT STARFLEET COMMAND"
6100 if s8 = 4 then 6160
6110 print "PROMOTES YOU ON E STEP  IN RANK, ";
6120 if s8 = 1 then print "FROM BEGINNER TO NOVICE CLASS!"
6130 if s8 = 2 then print "FROM NOVICE TO SENIOR CLASS!"
6140 if s8 = 3 then print "FROM SENIOR TO EXPERT CLASS!"
6150 print "  ***CONGRATULATIONS***" : goto 6190
6160 print "PROMOTES YOU TO 'COMMODORE EMERITUS'."
6170 print
6180 print "NOW YOU CAN RETIRE AND WRITE YOUR OWN STAR TREK GAME!"
6190 gosub 12110
6200 return
6210 rem-FED RESOURCES DEPLETED
6220 print "YOUR TIME HAS RUN OUT, AND THE"
6230 print "FEDERATION HAS BEEN CONQUERED." : print
6240 print "YOUR STARSHIP IS NOW KLINGON PROPERY, AND YOU ARE PUT"
6250 print "ON TRIAL AS A WAR CRIMINAL. ON THE BASIS OF YOUR RECORD,"
6260 if r1*3 > i1 then 6290
6270 print "YOU ARE FOUND GUILTY AND SENTENCED TO DEATH!"
6280 a1 = 0 : gosub 12110 : return
6290 print "YOU ARE ACQUITTED" : gosub 12110 : return
6300 rem- L.S. FAILURE
6310 print "YOUR LIFE SUPPORT RESERVES HAVE RUN OUT, AND"
6320 print "YOU WILL SOON DIE OF ASPHYXIATION"
6330 print
6340 print "YOUR STARSHIP IS A DERELICT IN SPACE."
6350 goto 6590
6360 rem-ENERGY GONE
6370 print "YOUR ENERGY SUPPLY IS EXHAUSTED." : goto 6330
6380 rem-BATTLE DEFEAT
6390 print "THE ";s5$;" HAS BEEN DESTROYED IN BATTLE."
6400 goto 6590
6410 print "F9=6 INVALID" : return
6420 rem-NOVA
6430 print "YOUR STARSHIP HAS BEEN DESTROYED BY A NOVA."
6440 print "NICE SHOT, YOU HOCKEY PUCK!" : goto 6590
6450 rem-SUPERNOVA
6460 print "THE ";s5$;" HAS BEEN INCINERATED BY A SUPERNOVA."
6470 goto 6590
6480 rem-ABANDON(NO BASES)
6490 print "YOU HAVE BEEN CAPTURED BY THE KLINGONS.  IF YOU STILL"
6500 print "HAD A STARBASE TO BE RETURNED TO , YOU WOULD HAVE BEEN"
6510 print "REPATRIATED AND GIVEN ANOTHER CHANCE. SINCE YOU HAVE"
6520 print "NO STARBASES, YOU WILL BE MERCILESSLY TORTURED TO DEATH!"
6530 goto 6590
6540 rem - SELF-DESTRUCT
6550 print : print "THE ";s5$;" IS NOW AN EXPANDING CLOUD"
6560 print "OF SUB-ATO MIC PARTICLES..." : goto 6590
6570 rem-NOT REMATERIALIZED
6580 print "STARBASE WAS UNABLE TO RE-MATERIALIZE YOUR STARSHIP."
6590 print
6600 if left$(s5$,1) = "F" then s5$ = ""
6610 if left$(s5$,1) = "E" then s5$ = "FAERIE QUEENE"
6620 a1 = 0
6630 if r1 = 0 then 6750
6640 g3 = r4/i3 : b8 = (r1+2*r2)/(i1+2*i4)
6650 a3 = g3/b8
6660 if a3 < 1+0.5+rnd(1) then 6730
6670 print "AS A RESULT OF YOUR ACTIONS, A TREATY WITH THE KLINGON"
6680 print "EMPIRE HAS BEEN SIGNED. THE TERMS OF THE TREATY ARE"
6690 if a3 < 3*rnd(1) then 6720
6700 print "FAVORABLE TO THE FEDERATION." : print
6710 print "CONGRATULATIONS." : goto 6740
6720 print "HIGHLY UNFAVORABLE TO THE FEDERATION." : goto 6740
6730 print "THE FEDERATION WILL BE DESTROYED!"
6740 gosub 12110 : return
6750 print "SINCE YOU TO OK THE LAST KLINGON WITH YOU, YOU ARE"
6760 print "A MARTYR AND A HERO. SOMEDAY MAYBE THEY'LL ERECT"
6770 print "A STATUE IN YOUR MEMORY. REST IN PEACE AND TRY NOT"
6780 print "TO THINK ABOUT PIGEONS!" : g1 = 1 : a1 = 0
6790 gosub 12110 : return
6800 rem - HELP
6810 if c5$ <> "DOCKED" then 6840
6820 print "ENSIGN CHEKOV- 'BUT CAPTAIN, WE'RE AL READ Y DOCKED!'"
6830 return
6840 if d4(9) = 0 then 6860
6850 print "SUBSPACE RADIO DAMAGED...CANNOT TRANSMIT." : return
6860 if r3 <> 0 then 6890
6870 print "LT. UHURA- 'CAPTAIN, I'M NOT GETTING ANY RESPONSE";
6880 print " FROM STARBASE!'" : return
6890 n1 = n1+1 : if b6 = 0 then 6910
6900 goto 6970
6910 d1 = 1.000000E+30
6920 for l = 1 to r3 : x = 10*sqr((b2(l)-q1)^2+(b3(l)-q2)^2)
6930 if x > d1 then 6950
6940 d1 = x : k = l
6950 next l
6960 q1 = b2(k) : q2 = b3(k) : gosub 9500
6970 q$(s6,s7) = "."
6980 print
6990 print "STARBASE IN QUADRANT ";q1;"-";q2;"RESPONDS --";
7000 print " ";s5$;" DEMATERIALIZES."
7010 p2 = (1-0.98^d1)^0.333333
7020 for l = 1 to 3
7030 if l = 1 then print "1ST ";
7040 if l = 2 then print "2ND ";
7050 if l = 3 then print "3RD ";
7060 print "ATTEMPT TO RE-MATERIALIZE THE ";s5$;". . . . .";
7070 if rnd(1) > p2 then 7100
7080 print "FAILS." : next l
7090 f9 = 11 : gosub 5940 : return
7100 for l = 1 to 5 : i = b6+int(3*rnd(1))-1
7110 if (i < 1) or (i > 10) then 7150
7120 j = b7+int(3*rnd(1))-1
7130 if (j < 1) or (j > 10) then 7150
7140 if q$(i,j) = "." then 7160
7150 next l : print "FAILS." : goto 7090
7160 print "SUCCEEDS." : s6 = i : s7 = j : q$(i,j) = left$(s5$,1)
7170 gosub 4510 : print "LT. UHURA- 'CAPTAIN, WE MADE IT!'" : return
7180 rem-HITEM
7190 p4 = 2 : l5 = k3 : n = 1
7200 for k = 1 to l5
7210 if h3(k) = 0 then 7470
7220 d6 = 0.9+0.01*rnd(1) : h2 = h3(k)*d6^k7(n)
7230 p3 = k6(n)
7240 p = abs(p3) : if p4*h2 < p then p = p4*h2
7250 k6(n) = p3-sgn(p3)*abs(p)
7260 x8 = k4(n) : y8 = k5(n)
7270 if h2 > 4.99 then 7290
7280 print "VERY SMALL HIT ON " : goto 7300
7290 print fnr(h2);"UNIT HIT ON ";
7300 m$ = q$(x8,y8)
7310 if m$ = "K" then print "KLINGON AT ";
7320 if m$ = "C" then print "COMMANDER AT ";
7330 print x8;"-";y8
7340 if k6(n) <> 0 then 7380
7350 a5 = x8 : a6 = y8 : t2$ = q$(x8,y8) : gosub 4220
7360 if r1 <> 0 then 7480
7370 f9 = 1 : gosub 5940 : goto 7480
7380 if k6(n) < 0 then 7470
7390 if rnd(1) < 0.9 then 7470
7400 if k6(n) > (0.4+0.4*rnd(1))*p3 then 7470
7410 print
7420 print "***MR. SPOCK - 'CAPTAIN, THE VESSEL AT SECTOR ";
7430 print x8;"-";y8
7440 print "  HAS JUST LOST ITS FIREPOWER.'"
7450 print
7460 k6(n) = -k6(n)
7470 n = n+1
7480 next k
7490 return
7500 rem - IMPULSE
7510 j3 = 0
7520 if d4(7) <> 0 then 7770
7530 if e1 <= 75 then 7580
7540 input "ENTER COURSE AND DISTANCE ";d2,d1
7550 if d2 < 0 then return
7560 p3 = 50+250*d1
7570 if p3 < e1 then 7660
7580 print
7590 print "1ST OFFICER SPOCK- 'CAPTAIN, THE IMPULSE ENGINES"
7600 print "REQUIRE 50 UNITS OF ENERGY TO ENGAGE, PLUS 250 UNITS"
7610 print "PER ";
7620 if e1 > 75 then 7640
7630 print "QUADRANT. THEY ARE, THEREFORE, USELESS NOW.'" : return
7640 print "QUADRANT. WE CAN GO, THEREFORE, A MAXIMUM OF ";
7650 print fnr(4.000000E-03*(e1-50)-0.05);"QUADRANTS.'" : return
7660 t1 = d1/0.4
7670 if t1 < r5 then 7720
7680 print "1ST OFFICER SPOCK- 'CAPTAIN, OUR SPEED UNDER IMPULSE"
7690 print "POWER IS ONLY 4 SECTORS PER STARDATE. ARE YOU SURE"
7700 input "WE DARE SPEND THE TIME' ";b$
7710 if left$(b$,1) <> "Y" then return
7720 gosub 8000 : j3 = 1
7730 if a2 <> 0 then return
7740 e1 = e1-p3
7750 if e1 > 0 then return
7760 f9 = 4 : gosub 5940 : return
7770 print "IMPULSE ENGINES DAMAGED." : return
7780 rem - LRSCAN
7790 n$ = "    # "
7800 print
7810 if d4(2) <> 0 then 7990
7820 print "L.R. SCAN FOR QUADRANT ";q1;"-";q2 : print
7830 i = q1-1 : j = q1+1 : k = q2-1 : l = q2+1
7840 for m = i to j : for n = k to l
7850 if (m <= 0) or (m > 8) then 7910
7860 if (n <= 0) or (n > 8) then 7910
7870 if d4(11) = 0 then s2(m,n) = 1
7880 if g(m,n) >= 1000 then print " ***";
7890 if g(m,n) < 1000 then print spc$(5-len(str$(g(m,n))));g(m,n);
7900 goto 7920
7910 print n$;
7920 next n
7930 print
7940 next m
7950 if d4(11) = 0 then return
7960 print
7970 print "***WARNING*** - COMPUTER DISABLED - SCAN NOT RECORDED."
7980 return
7990 print "LONG RANGE SENSORS DAMAGED." : return
8000 rem - MOVE
8010 a5 = (15-d2)*0.523599
8020 d4 = -sin(a5) : d6 = cos(a5)
8030 b8 = abs(d4)
8040 if abs(d6) > b8 then b8 = abs(d6)
8050 d4 = d4/b8 : d6 = d6/b8 : t5 = 0 : t6 = 0
8060 if d0+t1 < f1(2) then 8090
8070 t5 = 1 : c5$ = "RED" : d1 = d1*(f1(2)-d0)/t1+0.1
8080 t1 = f1(2)-d0+1.000000E-05
8090 q$(s6,s7) = "." : x7 = s6 : y7 = s7 : h9 = int(10*d1*b8+0.5)
8100 if h9 = 0 then 8200
8110 for l = 1 to h9
8120 x7 = x7+d4 : x1 = int(x7+0.5) : y7 = y7+d6 : y1 = int(y7+0.5)
8130 if (x1 < 1) or (x1 > 10) then 8370
8140 if (y1 < 1) or (y1 > 10) then 8370
8150 if q$(x1,y1) = "O" then 8180
8160 if q$(x1,y1) <> "." then 8250
8170 next l
8180 d1 = 0.1*sqr((s6-x1)^2+(s7-y1)^2)
8190 s6 = x1 : s7 = y1
8200 f4 = s6 : f5 = s7
8210 if q$(x1,y1) <> "O" then 8730
8220 t2 = fna(1) : t3 = fna(1)
8230 q1 = fna(1) : q2 = fna(1) : s6 = fnb(1) : s7 = fnb(1) : print
8240 print "*** SPACE PORTAL ENTERED ***" : goto 8700
8250 t6 = 1 : k = 50*d1/t1 : d1 = 0.1*sqr((s6-x1)^2+(s7-y1)^2)
8260 if (q$(x1,y1) = "K") or (q$(x1,y1) = "C") then 8360
8270 print : print s5$;" BLOCKED BY ";
8280 if q$(x1,y1) = "*" then print "STAR AT ";
8290 if q$(x1,y1) = "B" then print "STARBASE AT ";
8300 print " SECTOR ";x1;"-";y1;"...."
8310 print "EMERGENCY STOP REQUIRED ";fnr(k);"UNITS OF ENERGY."
8320 e1 = e1-k
8330 s6 = int(x7-d4+0.5) : f4 = s6 : s7 = int(y7-d6+0.5) : f5 = s7
8340 if e1 > 0 then 8730
8350 f9 = 4 : gosub 5940 : return
8360 s6 = x1 : s7 = y1 : gosub 11950 : f4 = s6 : f5 = s7 : goto 8730
8370 if k3 = 0 then 8430
8380 for l = 1 to k3
8390 f3 = sqr((x1-k4(l))^2+(y1-k5(l))^2)
8400 k8(l) = 0.5*(f3+k7(l)) : next l
8410 if g(q1,q2) <> 1000 then gosub 1520
8420 if a2 <> 0 then return
8430 x7 = 10*(q1-1)+s6 : y7 = 10*(q2-1)+s7
8440 x1 = int(x7+10*d1*b8*d4+0.5)
8450 y1 = int(y7+10*d1*b8*d6+0.5) : l6 = 0
8460 l5 = 0
8470 if x1 > 0 then 8490
8480 x1 = -x1+1 : l5 = 1
8490 if y1 > 0 then 8510
8500 y1 = -y1+1 : l5 = 1
8510 if x1 <= 80 then 8530
8520 x1 = 161-x1 : l5 = 1
8530 if y1 <= 80 then 8550
8540 y1 = 161-y1 : l5 = 1
8550 if l5 = 0 then 8570
8560 l6 = 1 : goto 8460
8570 if l6 = 0 then 8670
8580 print : print "*** MESSAGE FROM STARFLEET COMMAND.....STARDATE ";
8590 print fnr(d0) : print : print "'PERMISSION TO CROSS GALACTIC ";
8600 print "PERIMETER IS HEREBY DENIED.'"
8610 print "    'SHUT DOWN ENGINES IMMMEDIATELY!'"
8620 print
8630 print "SCOTT HERE - 'ENGINES SHUT DOWN AT ";
8640 z1 = int((x1+9)/10) : z2 = int((y1+9)/10)
8650 print "QUADRANT ";z1;"-";z2;", ";
8660 print "SECTOR ";x1-10*(z1-1);"-";y1-10*(z2-1);"'"
8670 if t5 <> 0 then return
8680 q1 = int((x1+9)/10) : q2 = int((y1+9)/10)
8690 s6 = x1-10*(q1-1) : s7 = y1-10*(q2-1)
8700 gosub 9830
8710 print : print "ENTERING THE ";g2$;" QUADRANT (";q1;"-";q2;")"
8720 q$(s6,s7) = left$(s5$,1) : gosub 9500 : return
8730 q$(s6,s7) = left$(s5$,1)
8740 if l6 = 1 then return
8750 if k3 = 0 then 8820
8760 for l = 1 to k3
8770 f3 = sqr((f4-k4(l))^2+(f5-k5(l))^2)
8780 k8(l) = 0.5*(k7(l)+f3)
8790 k7(l) = f3
8800 next l
8810 gosub 13880
8820 gosub 9450 : return
8830 rem-MOVECOM
8840 a = 1 : b = 1
8850 for k = 1 to k3
8860 c = k4(k) : d = k5(k)
8870 if q$(c,d) = "C" then 8890
8880 next k
8890 n = 0 : f = k6(k)+100*k3
8900 if f > 1000 then n = int(rnd(1)*k7(k)+1)
8910 if ((c5$ = "DOCKED") and ((b4 <> q1) or (b5 <> q2))) then n = -s8
8920 if n = 0 then n = int(((f+200*rnd(1))/150)-5)
8930 if n = 0 then return
8940 if (n > 0) and (k7(k) < 1.5) then return
8950 if abs(n) > s8 then n = sgn(n)*abs(s8)
8960 t = abs(n) : p = s6-c : q = s7-d
8970 if 2*abs(p) < abs(q) then p = 0
8980 if 2*abs(q) < abs(p) then q = 0
8990 if p <> 0 then p = sgn(p*n)
9000 if q <> 0 then q = sgn(q*n)
9010 r = c : s = d : q$(c,d) = "."
9020 for l2 = 1 to t : l = r+p : m = s+q
9030 if (l > 0) and (l <= 10) then 9050
9040 on sgn(n)+2 goto 9280,9140,9140
9050 if (m > 0) and (m <= 10) then 9070
9060 on sgn(n)+2 goto 9280,9080,9080
9070 if q$(l,m) = "." then 9200
9080 if (q = b) or (p = 0) then 9140
9090 m = s+b
9100 if (m > 0) and (m <= 10) then 9120
9110 on sgn(n)+2 goto 9280,9130,9130
9120 if q$(l,m) = "." then 9200
9130 b = -b
9140 if (p = a) or (q = 0) then 9210
9150 l = r+a
9160 if (l > 0) and (l <= 10) then 9180
9170 on sgn(n)+2 goto 9280,9190,9190
9180 if q$(l,m) = "." then 9200
9190 a = -a : goto 9210
9200 r = l : s = m
9210 next l2
9220 q$(r,s) = "C"
9230 if (r = c) and (s = d) then return
9240 k4(k) = r : k5(k) = s : k7(k) = sqr((s6-r)^2+(s7-s)^2)
9250 k8(k) = k7(k) : if n > 0 then print "***COMMANDER ADVANCES TO ";
9260 if n < 0 then print "***COMMANDER RETREATS TO ";
9270 print " SECTOR ";r;"-";s : gosub 13880 : return
9280 i = q1+int((l+9)/10)-1 : j = q2+int((m+9)/10)-1
9290 if (i < 1) or (i > 8) then 9440
9300 if (j < 1) or (j > 8) then 9440
9310 for l3 = 1 to r2
9320 if (c1(l3) = i) and (c2(l3) = j) then 9440
9330 next l3 : print "***COMMANDER ESCAPES TO ";
9340 print "QUADRANT ";i;"-";j;" (AND REGAINS STRENGTH)"
9350 k4(k) = k4(k3) : k5(k) = k5(k3) : k7(k) = k7(k3) : k8(k) = k8(k3)
9360 k6(k) = k6(k3) : k3 = k3-1 : c3 = 0
9370 if c5$ <> "DOCKED" then gosub 9450
9380 gosub 13880
9390 g(q1,q2) = g(q1,q2)-100 : g(i,j) = g(i,j)+100
9400 for l3 = 1 to r2
9410 if (c1(l3) = q1) and (c2(l3) = q2) then 9430
9420 next l3
9430 c1(l3) = i : c2(l3) = j : return
9440 a = -a : b = -b : goto 9210
9450 rem - NEWCOND
9460 c5$ = "GREEN"
9470 if e1 < 1000 then c5$ = "YELLOW"
9480 if g(q1,q2) > 99 then c5$ = "RED"
9490 return
9500 rem- NEW QUAD
9510 j4 = 1 : b6 = 0 : b7 = 0 : k3 = 0 : c3 = 0
9520 u = g(q1,q2)
9530 if u > 999 then 9810
9540 k3 = int(0.01*u) : for a = 1 to 10 : for b = 1 to 10 : q$(a,b) = "." : next b : next a
9550 q$(s6,s7) = left$(s5$,1) : u = g(q1,q2) : if u < 100 then 9670
9560 u = u-100*k3 : for a = 1 to k3
9570 s = fnb(1) : k4(a) = s : t = fnb(1) : k5(a) = t
9580 if q$(s,t) <> "." then 9570
9590 q$(s,t) = "K" : k7(a) = sqr((s6-s)^2+(s7-t)^2) : k8(a) = k7(a)
9600 k6(a) = rnd(1)*150+325 : next a
9610 if r2 = 0 then 9660
9620 for a = 1 to r2
9630 if (c1(a) = q1) and (c2(a) = q2) then 9650
9640 next a : goto 9660
9650 q$(s,t) = "C" : k6(k3) = 1000+400*rnd(1) : c3 = 1
9660 gosub 13880
9670 if u < 10 then 9710
9680 u = u-10
9690 b6 = fnb(1) : b7 = fnb(1) : if q$(b6,b7) <> "." then 9690
9700 q$(b6,b7) = "B"
9710 gosub 9450 : if u < 1 then return
9720 for a = 1 to u
9730 s = fnb(1) : t = fnb(1) : if q$(s,t) <> "." then 9730
9740 q$(s,t) = "*" : next a
9750 if (t2 <> q1) or (t3 <> q2) then return
9760 s = fnb(1) : t = fnb(1) : if q$(s,t) <> "." then 9760
9770 q$(s,t) = "O" : print
9780 print "MR. SPOCK - 'CAPTAIN, THE SHORT-RANGE SENSORS DETECT A"
9790 print "SPACE WARP SOMEWHERE IN THIS QUADRANT.'"
9800 return
9810 for a = 1 to 10 : for b = 1 to 10 : q$(a,b) = "." : next b : next a
9820 q$(s6,s7) = left$(s5$,1) : return
9830 g4$ = "III" : l = 2 : if q2 >= 5 then 9850
9840 l = 1
9850 g2$ = g1$(2*(q1-1)+l) : l = q2
9860 if l <= 4 then 9880
9870 l = q2-4
9880 g3$ = "IV" : if l = 4 then 9900
9890 g3$ = left$(g4$,l)
9900 g2$ = g2$+" "+g3$ : return
9910 rem - NOVA
9920 if rnd(1) > 0.1 then 9940
9930 gosub 13410 : return
9940 q$(a5,a6) = "." : print "***STAR AT SECTOR ";a5;"-";a6;"NOVAS."
9950 g(q1,q2) = g(q1,q2)-1 : s1 = s1+1
9960 b9 = 1 : t6 = 1 : t7 = 1 : k = 0 : x1 = 0 : y1 = 0
9970 h4(b9,1) = a5 : h4(b9,2) = a6
9980 for m = b9to t6 : for q = 1 to 3 : for j = 1 to 3
9990 if j*q = 4 then 10430
10000 j5 = h4(m,1)+q-2 : j6 = h4(m,2)+j-2
10010 if (j5 < 1) or (j5 > 10) then 10430
10020 if (j6 < 1) or (j6 > 10) then 10430
10030 if q$(j5,j6) = "." then 10430
10040 if q$(j5,j6) = "O" then 10430
10050 if q$(j5,j6) <> "*" then 10110
10060 if rnd(1) >= 0.1 then 10080
10070 x2 = j5 : y2 = j6 : gosub 13410 : return
10080 t7 = t7+1 : h4(t7,1) = j5 : h4(t7,2) = j6 : g(q1,q2) = g(q1,q2)-1
10090 s1 = s1+1 : print "***STAR AT SECTOR ";j5;"-";j6;"NOVAS."
10100 goto 10420
10110 if q$(j5,j6) <> "B" then 10180
10120 g(q1,q2) = g(q1,q2)-10 : for v = 1 to r3
10130 if (b2(v) <> q1) or (b3(v) <> q2) then 10150
10140 b2(v) = b2(r3) : b3(v) = b3(r3)
10150 next v : r3 = r3-1 : b6 = 0 : b7 = 0 : b1 = b1+1 : gosub 9450
10160 print "***STARBASE AT SECTOR ";j5;"-";j6;"DESTROYED."
10170 goto 10420
10180 if (s6 <> j5) or (s7 <> j6) then 10280
10190 print "***STARSHIP BUFFETED BY NOVA." : if s4 <> 0 then 10210
10200 e1 = e1-1000 : goto 10240
10210 if s3 >= 1000 then 10260
10220 d6 = 1000-s3 : e1 = e1-d6 : gosub 9450 : s3 = 0 : s4 = 0
10230 print "***STARSHIP SHIELDS KNOCKED OUT." : d4(8) = 5.000000E-03*d5*rnd(1))*d6
10240 if e1 > 0 then 10270
10250 f9 = 7 : gosub 5940 : return
10260 s3 = s3-1000
10270 x1 = x1+s6-h4(m,1) : y1 = y1+s7-h4(m,2) : k = k+1 : goto 10430
10280 if q$(j5,j6) <> "C" then 10410
10290 for v = 1 to k3
10300 if (k4(v) = j5) and (k5(v) = j6) then 10320
10310 next v
10320 k6(v) = k6(v)-800 : if k6(v) <= 0 then 10410
10330 n5 = j5+j5-h4(m,1) : n6 = j6+j6-h4(m,2)
10340 print "***COMMANDER AT SECTOR ";j5;"-";j6;"DAMAGED";
10350 if (n5 < 1) or (n5 > 10) or (n6 < 1) or (n6 > 10) then 10400
10360 print " AND BUFFETED TO SECTOR ";n5;"-";n6
10370 q$(n5,n6) = "C" : k4(v) = n5 : k5(v) = n6
10380 k7(v) = sqr((s6-n5)^2+(s7-n6)^2) : k8(v) = k7(v)
10390 q$(j5,j6) = "."
10400 print : goto 10430
10410 a5 = j5 : a6 = j6 : t2$ = q$(j5,j6) : gosub 4220 : goto 10430
10420 print : q$(j5,j6) = "."
10430 next j : next q : next m
10440 if t6 = t7 then 10460
10450 b9 = t6+1 : t6 = t7 : goto 9980
10460 if k = 0 then return
10470 d1 = k*0.1
10480 if x1 <> 0 then x1 = sgn(x1)
10490 if y1 <> 0 then y1 = sgn(y1)
10500 i = 3*(x1+1)+y1+2
10510 d2 = c5(i)
10520 if d2 = 0 then d1 = 0
10530 if d1 = 0 then return
10540 print : print " FOR CE OF NOVA DISPLACES STARSHIP."
10550 gosub 8000 : return
10560 rem-PHASERS
10570 p = 2 : j3 = 1
10580 if c5$ <> "DOCKED" then 10600
10590 print "PHASERS CAN'T BE FIRED THRU BASE SHIELDS." : goto 10680
10600 if d4(3) = 0 then 10620
10610 print "PHASER BANKS DAMAGED." : goto 10680
10620 if s4 = 0 then 10640
10630 print "SHIELDS MUST BE DOWN TO FIRE PHASERS." : goto 10680
10640 if k3 > 0 then 10690
10650 print
10660 print "MR. SPOCK - 'CAPTAIN, THE SHORT-RANGE SENSORS"
10670 print "  DETECT NO KLINGONS IN THIS QUADRANT.'"
10680 j3 = 0 : return
10690 print "PHASERS LOCKED ON TARGET. ENERGY AVAILABLE=";
10700 print 0.01*int(100*e1)
10710 input "UNITS TO FIRE ";p1 : if p1 < e1 then 10730
10720 print "ENERGY AVAILABLE ="; : goto 10700
10730 if p1 > 0 then 10750
10740 j3 = 0 : return
10750 e1 = e1-p1
10760 if d4(11) = 0 then 10790
10770 p1 = p1*(rnd(1)*0.5+0.5)
10780 print : print "COMPUTER MALFUNCTION HAMPERS PHASER ACCURACY." : print
10790 e = p1 : if k3 = 0 then 10960
10800 e = 0 : t5 = (k3*(k3+1))/2
10810 for i = 1 to k3 : h3(i) = ((k3+1-i)/t5)*p1
10820 h5(i) = abs(k6(i))/(p*0.9^k7(i))
10830 if h3(i) <= h5(i) then 10850
10840 e = e+(h3(i)-h5(i)) : h3(i) = h5(i)
10850 next i
10860 if e = 0 then 10930
10870 for i = 1 to k3 : r7 = h5(i)-h3(i)
10880 if r7 <= 0 then 10910
10890 if r7 >= e then 10920
10900 h3(i) = h5(i) : e = e-r7
10910 next i : goto 10930
10920 h3(i) = h3(i)+e : e = 0
10930 gosub 7180
10940 if (e <> 0) and (a2 = 0) then 10960
10950 j3 = 1 : return
10960 print fnr(e);"EXPENDED ON EMPTY SPACE." : j3 = 1 : return
10970 rem - PHOTO NS
10980 j3 = 1 : if d4(4) = 0 then 11000
10990 print "PHOTON TUBES DAMAGED." : goto 11040
11000 if t4 <> 0 then 11020
11010 print "NO TORPEDOS LEFT." : goto 11040
11020 input "TORPEDO COURSE ";c6
11030 if c6 >= 0 then 11050
11040 j3 = 0 : return
11050 input "BURST OF 3 ";b$ : n = 1
11060 if left$(b$,1) = "N" then 11150
11070 if left$(b$,1) <> "Y" then 11050
11080 if t4 > 2 then 11100
11090 print "NO BURST. ONLY ";t4;"TORPEDOS LEFT." : goto 11040
11100 input "SPREAD ANGLE (3 - 30 DEG) ";g2
11110 if g2 < 0 then 11040
11120 if (g2 < 3) or (g2 > 30) then 11100
11130 g2 = fnd(g2)
11140 n = 3
11150 rem - CONTINUE
11160 for z6 = 1 to n
11170 if c5$ <> "DOCKED" then t4 = t4-1
11180 z7 = z6 : r = rnd(1)
11190 r = (r+rnd(1))*0.5-0.5
11200 if (r >= -0.4) and (r <= 0.4) then 11270
11210 r = (rnd(1)+1.2)*r : if n = 3 then 11230
11220 print "***TORPEDO MISFIRES..." : goto 11240
11230 print "***TORPEDO NUMBER ";z6;"MISFIRES..."
11240 if rnd(1) > 0.2 then 11270
11250 print "***PHOTO N TUBES DAMAGED BY MISFIRE."
11260 d4(4) = d5*(1+2*rnd(1)) : goto 11930
11270 if (s4 <> 0) or (c5$ = "DOCKED") then r = r+1.000000E-03*s3*r
11280 a3 = c6+0.25*r : if n = 1 then 11310
11290 a8 = (15-a3+(2-z6)*g2)*0.523599 : print
11300 print "TRACK FOR TORPEDO NUMBER ";z7;"--" : goto 11320
11310 print : print "TORPEDO TRACK --" : a8 = (15-a3)*0.523599
11320 x4 = -sin(a8) : y4 = cos(a8) : b8 = abs(x4)
11330 if abs(y4) > abs(x4) then b8 = abs(y4)
11340 x4 = x4/b8 : y4 = y4/b8 : x5 = s6 : y5 = s7
11350 for l9 = 1 to 15 : x5 = x5+x4 : a5 = int(x5+0.5)
11360 if (a5 < 1) or (a5 > 10) then 11910
11370 y5 = y5+y4 : a6 = int(y5+0.5)
11380 if (a6 < 1) or (a6 > 10) then 11910
11390 if (l9 = 5) or (l9 = 9) then print
11400 print fnr(x5);"-";fnr(y5);", ";
11410 if q$(a5,a6) <> "." then 11430
11420 goto 11900
11430 print : if q$(a5,a6) = "K" then 11480
11440 if q$(a5,a6) <> "C" then 11700
11450 if rnd(1) > 0.1 then 11480
11460 print "***COMMANDER AT SECTOR ";a5;"-";a6;"USES ANTI-PHOTON ";
11470 print " DEVICE!" : print "  TORPEDO NEUTRALIZED." : goto 11920
11480 for v = 1 to k3
11490 if (a5 = k4(v)) and (a6 = k5(v)) then 11510
11500 next v
11510 k = k6(v) : w3 = 200+800*rnd(1)
11520 if abs(k) < w3 then w3 = abs(k)
11530 k6(v) = k-sgn(k)*abs(w3) : if k6(v) <> 0 then 11550
11540 t2$ = q$(a5,a6) : gosub 4220 : goto 11920
11550 if q$(a5,a6) = "K" then print "***KLINGON AT ";
11560 if q$(a5,a6) = "C" then print "***COMMANDER AT ";
11570 print a5;"-";a6;
11580 a7 = a8+2.5*(rnd(1)-0.5)
11590 w3 = abs(-sin(a7)) : if abs(cos(a7)) > w3 then w3 = abs(cos(a7))
11600 x7 = -sin(a7)/w3 : y7 = cos(a7)/w3
11610 p = int(a5+x7+0.5) : q = int(a6+y7+0.5)
11620 if (p < 1) or (p > 10) or (q < 1) or (q > 10) then 11690
11630 if q$(p,q) <> "." then 11690
11640 q$(p,q) = q$(a5,a6) : q$(a5,a6) = "." : print "DAMAGED--"
11650 print "  DISPLACED BY BLAST TO SECTOR ";p;"-";q
11660 k4(v) = p : k5(v) = q : k7(v) = sqr((s6-p)^2+(s7-q)^2)
11670 k8(v) = k7(v)
11680 gosub 13880 : goto 11920
11690 print "DAMAGED, BUT NOT DESTROYED." : goto 11920
11700 if q$(a5,a6) <> "B" then 11780
11710 print "***STARBASE DESTROYED...CONGRATULATIONS...YOU TURKEY!"
11720 if s2(q1,q2) < 0 then s2(q1,q2) = 0
11730 for w = 1 to r3
11740 if (b2(w) <> q1) or (b3(w) <> q2) then 11760
11750 b2(w) = b2(r3) : b3(w) = b3(r3)
11760 next w : q$(a5,a6) = "." : r3 = r3-1 : b6 = 0 : b7 = 0
11770 g(q1,q2) = g(q1,q2)-10 : b1 = b1+1 : gosub 9450 : goto 11920
11780 if q$(a5,a6) <> "*" then 11860
11790 if rnd(1) > 0.15 then 11820
11800 print "***STAR AT SECTOR ";a5;"-";a6;"UNAFFECTED BY PHOTON BLAST"
11810 goto 11920
11820 x2 = a5 : y2 = a6 : gosub 9910 : a5 = x2 : a6 = y2
11830 if g(q1,q2) = 1000 then return
11840 if a2 <> 0 then return
11850 goto 11920
11860 print : print "AAAAAIIIIIIIEEEEEEEAAAAAAAUUUUUUGGGGGGGHHHHHHHHHH!!!"
11870 print "  HACK!   HACK!  COUGH!   *CHOKE!*"
11880 print : print "MR. SPOCK- 'FASCINATING!'" : q$(a5,a6) = "."
11890 t2 = 0 : t3 = 0 : goto 11920
11900 next l9
11910 print : print "TORPEDO MISSED!"
11920 next z6
11930 if r1 <> 0 then return
11940 f9 = 1 : gosub 5940 : return
11950 rem - RAM
11960 print : print "*** RED ALERT!!  RED ALERT!! ***" : print
11970 print "*** COLLISION IMMINENT!!" : print
11980 print "*** ";s5$;" RAMS "; : w7 = 1 : if q$(s6,s7) = "C" then w7 = 2
11990 if w7 = 1 then print "KLINGON AT ";
12000 if w7 = 2 then print "COMMANDER AT ";
12010 print "SECTOR ";s6;"-";s7 : a5 = s6 : a6 = s7 : t2$ = q$(s6,s7)
12020 gosub 4220 : print "***";s5$;" HEAVILY DAMAGED."
12030 k = int(5+rnd(1)*20) : print "***SICKBAY REPORTS ";k;"CASUALTIES!"
12040 c4 = c4+k : for l = 1 to 12 : i = rnd(1)
12050 j = (3.5*w7*(rnd(1)+i)+1)*d5
12060 if l = 6 then j = j/3
12070 d4(l) = d4(l)+t1+j : next l : d4(6) = d4(6)-3
12080 if d4(6) < 0 then d4(6) = 0
12090 s4 = 0 : if r1 <> 0 then return
12100 f9 = 1 : gosub 5940 : return
12110 rem - SCORE
12120 p = d0-j2 : if (p <> 0) and (r1 = 0) then 12140
12130 if p < 5 then p = 5
12140 n = (k2+k1)/p : k = int(500*n+0.5) : l = 0
12150 if g1 <> 0 then l = 100*s8
12160 i = 0
12170 if left$(s5$,1) = "E" then m = 0
12180 if left$(s5$,1) = "F" then m = 1
12190 if left$(s5$,1) = "" then m = 2
12200 if a1 = 0 then i = 200
12210 j = 10*k1+50*k2+k+l-i-100*b1-100*m-35*n1-3*s1-c4
12220 print : if j <> 0 then 12240
12230 print "AS YET, YOU HAVE NO SCORE." : return
12240 print "YOUR SCORE --" : print : if k1 = 0 then 12260
12250 print k1;tab (5);"ORDINARY KLINGON(S) DESTROYED";tab (36);10*k1
12260 if k2 = 0 then 12280
12270 print k2;tab (5);"KLINGON COMMANDER(S) DESTROYED";tab (36);50*k2
12280 if k = 0 then 12310
12290 print fnr(n);tab (5);"KLINGONS PER STARDATE, AVERAGE";
12300 print tab (36);k
12310 if s1 = 0 then 12330
12320 print s1;tab (5);"STAR(S) DESTROYED";tab (36);-3*s1
12330 if b1 = 0 then 12350
12340 print b1;tab (5);"STARBASES DESTROYED";tab (36);-100*b1
12350 if n1 = 0 then 12370
12360 print n1;tab (5);"SOS CALL(S) TO A STARBASE";tab (36);-35*n1
12370 if c4 = 0 then 12390
12380 print c4;tab (5);"CASUALTIES INCURRED";tab (36);-c4
12390 if m = 0 then 12410
12400 print m;tab (5);"SHIP(S) LOST OR DESTROYED";tab (36)-100*m
12410 if a1 <> 0 then 12430
12420 print "PENALTY FOR GETTING YOURSELF KILLED";tab (36);-200
12430 if g1 = 0 then 12450
12440 print tab (5);"BONUS FOR WINNING ";s$(s8);" GAME";tab (36);l
12450 print tab (5);"-------------------------------------"
12460 print tab (28);"TOTAL";tab (36);j;"**" : return
12470 rem-SETUP
12480 a2 = 0 : g1 = 0 : gosub 3110 : s5$ = "ENTERPRISE"
12490 i7 = 5000 : e1 = i7 : i8 = 2500 : s3 = i8 : s4 = 0 : s9 = s4 : j1 = 4 : l1 = j1
12500 q1 = fna(1) : q2 = fna(1) : s6 = fnb(1) : s7 = fnb(1) : i9 = 10 : t4 = i9
12510 w1 = 5 : w2 = 25 : for i = 1 to 12 : d4(i) = 0 : next
12520 j2 = 100*int(31*rnd(1)+20) : d0 = j2 : k1 = 0 : k2 = 0 : n1 = 0 : n2 = 0 : r6 = 0 : c4 = 0
12530 a1 = 1 : d3 = 0.25 : for i = 1 to 8 : for j = 1 to 8 : s2(i,j) = 0 : next j : next i
12540 f1(1) = d0-0.5*i5*log(rnd(1)) : f1(5) = 1.000000E+30
12550 f1(2) = d0-1.5*(i5/r2)*log(rnd(1)) : i6 = 0
12560 f1(3) = d0-0.3*i5*log(rnd(1)) : f1(4) = d0-0.3*i5*log(rnd(1))
12570 for i = 1 to 8 : for j = 1 to 8 : k = int(rnd(1)*9+1) : i6 = i6+k
12580 g(i,j) = k : next j : next i : s1 = 0
12590 for i = 1 to i2
12600 x = int(rnd(1)*6+2) : y = int(rnd(1)*6+2)
12610 if g(x,y) >= 10 then 12600
12620 if i < 2 then 12660
12630 k = i-1 : for j = 1 to k : d1 = sqr((b2(j)-x)^2+(b3(j)-y)^2)
12640 if d1 < 2 then 12600
12650 next j
12660 b2(i) = x : b3(i) = y : s2(x,y) = -1 : g(x,y) = g(x,y)+10 : next i
12670 b1 = 0 : k = i1-i4 : l = int(0.25*s8*(9-l2)+1)
12680 m = int((1-rnd(1)^2)*l) : if m > k then m = k
12690 n = 100*m
12700 x = fna(1) : y = fna(1) : if g(x,y)+n > 999 then 12700
12710 g(x,y) = g(x,y)+n : k = k-m : if k <> 0 then 12680
12720 for i = 1 to i4
12730 x = fna(1) : y = fna(1) : if (g(x,y) < 99) and (rnd(1) < 0.75) then 12730
12740 if g(x,y) > 899 then 12730
12750 if i = 1 then 12780
12760 m = i-1 : for j = 1 to m : if (c1(j) = x) and (c2(j) = y) then 12730
12770 next j
12780 g(x,y) = g(x,y)+100 : c1(i) = x : c2(i) = y : next i
12790 i = int(d0) : print : s0 = 0
12800 t2 = fna(1) : t3 = fna(1) : if g(t2,t3) < 100 then 12800
12810 if s8 <> 1 then 12940
12820 print "IT IS STARDATE ";i;"...THE ORGANIAN PEACE TREATY BETWEEN"
12830 print "THE UNITED FEDERATION OF PLANETS AND THE KLINGON EMPIRE"
12840 print "HAS COLLAPSED AND THE FEDERATION IS BEING ATTACKED BY A"
12850 print "DEADLY KLINGON INVASION FLEET. AS CAPTAIN OF THE"
12860 starship ""
12870 print "U.S.S. ENTERPRISE, IT IS YOUR MISSION TO SEEK OUT AND"
12880 print "DESTROY THIS INVASION FOR CE OF ";i1;"BATTLE CRUISERS."
12890 print : print "YOU HAVE AN INITIAL ALLOTMENT OF ";int(i5);
12900 print "STARDATES" : print "TO COMPLETE YOUR MISSION."
12910 print "AS THE MISSION PROCEEDS, YOU MAY BE GIVEN MORE TIME."
12920 print : print "YOU WILL HAVE ";i2;"SUPPORTING STARBASE(S)." : print
12930 goto 13020
12940 print "STARDATE..............";i
12950 print "NUMBER OF KLINGONS....";i1
12960 print "NUMBER OF STARDATES...";int(i5)
12970 print "NUMBER OF STARBASES...";i2
12980 print "STARBASE LOCATIONS....";
12990 for i = 1 to i2 : print b2(i);"-";b3(i);
13000 if i <> i2 then print ", ";
13010 next i : print : print
13020 gosub 9830
13030 print "THE ";s5$;" IS CURRENTLY IN THE ";g2$;" QUADRANT."
13040 gosub 9500 : return
13050 rem - SETWARP
13060 input "WARP FACTOR ";k
13070 print
13080 if k < 1 then 13220
13090 if k > 10 then 13230
13100 j = w1 : w1 = k : w2 = w1*w1
13110 if (w1 <= j) or (w1 <= 6) then 13140
13120 if w1 <= 8 then 13150
13130 if w1 > 8 then 13170
13140 print "ENSIGN CHEKOV - 'WARP FACTOR ";w1;"CAPTAIN'" : return
13150 print "ENGINEER SCOTT - 'AYE, BUT OUR MAXIMUM SAFE SPEED";
13160 print " IS WARP 6.'" : return
13170 if w1 = 10 then 13200
13180 print "ENGINEER SCOTT-'AYE, CAPTAIN, BUT OUR ENGINES MAY NOT ";
13190 print "TAKE IT.'" : return
13200 print "ENGINEER SCOTT-'AYE, CAPTAIN, WE'LL GIVE IT A TRY." : RETURN
13220 print "ENSIGN CHEKOV-'WE CAN'T GO BELOW WARP 1, CAPTAIN.'" : return
13230 print "ENSIGN CHEKOV-'OUR TO P SPEED IS WARP 10, CAPTAIN.'"
13240 return
13250 rem - SHIELDS
13260 j3 = 0 : if d4(8) <> 0 then 13380
13270 if s4 <> 0 then 13310
13280 input "SHIELDS ARE DOWN. DO YOU WANT THEM UP ";b$
13290 if left$(b$,1) = "Y" then 13340
13300 return
13310 input "SHIELDS ARE UP. DO YOU WANT THEM DOWN ";b$
13320 if left$(b$,1) = "Y" then 13370
13330 return
13340 s4 = 1 : s9 = 1 : if c5$ <> "DOCKED" then e1 = e1-50
13350 print "SHIELDS RAISED." : if e1 <= 0 then 13390
13360 j3 = 1 : return
13370 s4 = 0 : s9 = 1 : print "SHIELDS LOWERED." : j3 = 1 : return
13380 print "SHIELDS DAMAGED AND DOWN." : return
13390 print : print "SHIELDS USE UP LAST OF THE ENERGY."
13400 f9 = 4 : gosub 5940 : return
13410 rem - SUPERNOVA
13420 if x2 <> 0 then 13520
13430 n = int(rnd(1)*i6+1) : for x = 1 to 8 : for y = 1 to 8
13440 n = n-(g(x,y)-int(g(x,y)/10)*10) : if n <= 0 then 13460
13450 next y : next x : return
13460 if (x <> q1) or (y <> q2) then 13580
13470 if j4 <> 0 then 13580
13480 n = int(rnd(1)*(g(x,y)-int(g(x,y)/10)*10))+1
13490 for x3 = 1 to 10 : for y3 = 1 to 10 : if q$(x3,y3) <> "*" then 13510
13500 n = n-1 : if n = 0 then 13520
13510 next y3 : next x3
13520 print : print "*** RED ALERT!! RED ALERT!! ***"
13530 x3 = x2 : y3 = y2
13540 print "*** INCIPIENT SUPERNOVA DETECTED AT SECTOR ";x3;"-";y3
13550 x = q1 : y = q2 : k = (x2-s6)^2+(y2-s7)^2
13560 if k > 1.5 then 13620
13570 print "*** EMERGENCY AUTO -OVERRIDE JAMMED ***" : a2 = 1 : goto 13620
13580 if d4(9) <> 0 then 13620
13590 print : print "MESSAGE FROM STARFLEET COMMAND...STARDATE ";int(d0)
13600 print "'SUPERNOVA IN QUADRANT ";x;"-";y;
13610 print "....CAUTION ADVISED'"
13620 n = g(x,y) : r = int(n/100) : q = 0
13630 if (x <> q1) or (y <> q2) then 13650
13640 k3 = 0 : c3 = 0
13650 if r = 0 then 13710
13660 r1 = r1-r : if r2 = 0 then 13710
13670 for l = 1 to r2 : if (c1(l) <> x) or (c2(l) <> y) then 13700
13680 c1(l) = c1(r2) : c2(l) = c2(r2) : c1(r2) = 0 : c2(r2) = 0
13690 r2 = r2-1 : r = r-1 : q = 1 : if r2 = 0 then f1(2) = 1.000000E+30
13700 next l
13710 if r3 = 0 then 13750
13720 for l = 1 to r3 : if (b2(l) <> x) or (b3(l) <> y) then 13740
13730 b2(l) = b2(r3) : b3(l) = b3(r3) : b2(r3) = 0 : b3(r3) = 0 : r3 = r3-1
13740 next l
13750 if x2 = 0 then 13790
13760 n = g(x,y)-int(g(x,y)/100)*100
13770 s1 = s1+(n-int(n/10)*10) : b1 = b1+int(n/10)
13780 k1 = k1+r : k2 = k2+q
13790 if (s2(x,y) <> 0) and (d4(9) <> 0) then s2(x,y) = 1000+g(x,y)
13800 if (d4(9) = 0) or ((q1 = x) and (q2 = y)) then s2(x,y) = 1
13810 g(x,y) = 1000
13820 if (r1 <> 0) or ((x = q1) and (y = q2)) then 13860
13830 print : print "MR. SPOCK- 'CAPTAIN, A SUPERNOVA IN QUADRANT ";
13840 print x;"-";y;"HAS JUST DESTROYED THE LAST OF THE KLINGONS.'"
13850 f9 = 1 : gosub 5940 : return
13860 if a2 = 0 then return
13870 f9 = 8 : gosub 5940 : return
13880 rem - SORTKL
13890 if k3 <= 1 then return
13900 z4 = 0
13910 for o = 1 to k3-1 : if k7(o) <= k7(o+1) then 13980
13920 k = k7(o) : k7(o) = k7(o+1) : k7(o+1) = k
13930 k = k8(o) : k8(o) = k8(o+1) : k8(o+1) = k
13940 k = k4(o) : k4(o) = k4(o+1) : k4(o+1) = k
13950 k = k5(o) : k5(o) = k5(o+1) : k5(o+1) = k
13960 k = k6(o) : k6(o) = k6(o+1) : k6(o+1) = k
13970 z4 = 1
13980 next o
13990 if z4 <> 0 then 13900
14000 return
14010 rem-SRSCAN
14020 if d4(1) <> 0 then 14260 : rem damage ? rhn
14030 print : print "  1 2 3 4 5 6 7 8 9 10"
14040 for i = 1 to 10 : if i < 10 then print " ";
14050 print i; : for j = 1 to 10 : print q$(i,j);" "; : next j
14060 if i <= 5 then goto 14080,14090,14110,14120,14170
14070 on i-5 goto 14180,14190,14200,14230,14240
14080 print " STARDATE    ";fnr(d0) : goto 14250
14090 if c5$ <> "DOCKED" then gosub 9450
14100 print " CONDITION   ";c5$ : goto 14250
14110 print " POSITION    ";q1;"-";q2;", ";s6;"-";s7 : goto 14250
14120 print " LIFE SUPPORT  "; : if d4(5) <> 0 then 14140
14130 print "ACTIVE" : goto 14250
14140 if c5$ <> "DOCKED" then 14160
14150 print "DAMAGED, SUPPORTED BY STARBASE" : goto 14250
14160 print "DAMAGED, RESERVES=";fns(l1) : goto 14250
14170 print " WARP FACTOR  ";fnr(w1) : goto 14250
14180 print " ENERGY ";spc$(8);0.01*int(100*e1) : goto 14250
14190 print " TORPEDOS     ";t4 : goto 14250
14200 print " SHIELDS      "; : b$ = "DOWN," : if s4 <> 0 then b$ = "UP,"
14210 if d4(8) > 0 then b$ = "DAMAGED,"
14220 print b$;int(100*s3/i8+0.5);"%" : goto 14250
14230 print " KLINGONS LEFT ";r1 : goto 14250
14240 print " TIME LEFT    ";fns(r5)
14250 next i : return
14260 print "SHORT RANGE SENSORS DAMAGED." : return
14270 rem - TIMEWARP
14280 print : print "*** TIME WARP ENTERED ***" : print "YOU ARE TRAVELING"
14290 ";"
14300 if s0 <> 0 then 14340
14310 t1 = -0.5*i5*log(rnd(1))
14320 print " FOR WARD IN TIME ";fnr(t1);"STARDATES."
14330 f1(2) = f1(2)+t1 : goto 14500
14340 m = d0 : d0 = d9(1)
14350 print "BACKWARD IN TIME ";fnr(m-d0);"STARDATES." : s0 = 0
14360 r1 = d9(2) : r2 = d9(3) : r3 = d9(4) : r4 = d9(5) : r5 = d9(6)
14370 s1 = d9(7) : b1 = d9(8) : k1 = d9(9) : k2 = d9(10)
14380 for i = 1 to 8 : for j = 1 to 8 : g(i,j) = d9(i-1+8*(j-1)+11) : next j : next i
14390 for i = 75 to 84 : c1(i-74) = d9(i) : next
14400 for i = 85 to 94 : c2(i-84) = d9(i) : next
14410 for i = 95 to 99 : b2(i-94) = d9(i) : next
14420 for i = 100 to 104 : b3(i-99) = d9(i) : next : b4 = d9(105) : b5 = d9(106)
14430 f1(1) = d0-0.5*i5*log(rnd(1))
14440 if r2 <> 0 then f1(2) = d0-(i5/r2)*log(rnd(1))
14450 f1(3) = d0-0.5*i5*log(rnd(1))
14460 for i = 1 to 8 : for j = 1 to 8 : if 1 < s2(i,j) then s2(i,j) = 1
14470 next j : next i
14480 print
14490 print "SPOCK HAS RECONSTRUCTED A CORRECT STAR CHART FROM MEMORY."
14500 gosub 9500 : return
14510 rem - TRANSFER
14520 j3 = 0
14530 if d4(12) <> 0 then 14660
14540 input "NUMBER OF UNITS TO SHIELDS ";z3
14550 if z3 < 0 then return
14560 if e1+s3-z3 > 0 then 14590
14570 print "SCOTT HERE- 'WE ONLY HAVE ";fnr(e1+s3);"UNITS LEFT.'"
14580 return
14590 e1 = e1+s3-z3 : s3 = z3 : print "--ENERGY TRANSFER COMPLETE--"
14600 print "(SHIP ENERGY=";fnr(e1);"  SHIELD ENERGY=";fnr(s3);")"
14610 j3 = 1
14620 t1 = 0.1 : p5 = (k3+4*c3)/48 : if p5 < 0.1 then p5 = 0.1
14630 if p5 > rnd(1) then gosub 1520
14640 if a2 <> 0 then return
14650 gosub 4760 : return
14660 print "TRANSFER PANEL DAMAGED." : return
14670 rem - VISUAL
14680 input "WHICH DIRECTION ";z
14690 print
14700 j3 = 0 : if z < 0 then return
14710 if z <= 12 then 14730
14720 print "DIRECTIONS ARE FROM 0 TO 12 ONLY" : goto 14680
14730 t1 = 0.05 : p = (k3+4*c3)/48 : if p < 0.05 then p = 0.05
14740 if p > rnd(1) then gosub 1520
14750 if a2 <> 0 then return
14760 gosub 4760 : j3 = 1 : if a2 <> 0 then return
14770 d5 = int((z/12)*8+1.5) : if d5 > 8 then d5 = 1
14780 for i = 1 to 5 : for j = 1 to 5 : v$(i,j) = " " : next j : next i : n = 0
14790 v$(3,3) = left$(s5$,1)
14800 on d5 goto 14810,14850,14890,14930,14970,15010,15050,15090
14810 i = s6-2 : j = s7-2 : v$(1,1) = q$ : if (j > 0) and (i > 0) then v$(1,1) = q$(i,j)
14820 i = s6-1 : j = s7-1 : v$(2,2) = q$ : if (i > 0) and (j > 0) then v$(2,2) = q$(i,j)
14830 n = n+1 : if n = 3 then 15140
14840 i = s6-2 : v$(1,2) = q$ : if (i > 0) and (j > 0) then v$(1,2) = q$(i,j)
14850 i = s6-2 : v$(1,3) = q$ : if i > 0 then v$(1,3) = q$(i,s7)
14860 i = s6-1 : v$(2,3) = q$ : if i > 0 then v$(2,3) = q$(i,s7)
14870 n = n+1 : if n = 3 then 15140
14880 i = s6-2 : j = s7+1 : v$(1,4) = q$ : if (i > 0) and (j < 11) then v$(1,4) = q$(i,j)
14890 i = s6-2 : j = s7+2 : v$(1,5) = q$ : if (i > 0) and (j < 11) then v$(1,5) = q$(i,j)
14900 i = s6-1 : j = s7+1 : v$(2,4) = q$ : if (i > 0) and (j < 11) then v$(2,4) = q$(i,j)
14910 n = n+1 : if n = 3 then 15140
14920 j = s7+2 : v$(2,5) = q$ : if (i > 0) and (j < 11) then v$(2,5) = q$(i,j)
14930 j = s7+2 : v$(3,5) = q$ : if j < 11 then v$(3,5) = q$(s6,j)
14940 j = s7+1 : v$(3,4) = q$ : if j < 11 then v$(3,4) = q$(s6,j)
14950 n = n+1 : if n = 3 then 15140
14960 i = s6+1 : j = s7+2 : v$(4,5) = q$ : if (i < 11) and (j < 11) then v$(4,5) = q$(i,j)
14970 i = s6+2 : j = s7+2 : v$(5,5) = q$ : if (i < 11) and (j < 11) then v$(5,5) = q$(i,j)
14980 i = s6+1 : j = s7+1 : v$(4,4) = q$ : if (i < 11) and (j < 11) then v$(4,4) = q$(i,j)
14990 n = n+1 : if n = 3 then 15140
15000 i = s6+2 : v$(5,4) = q$ : if (i < 11) and (j < 11) then v$(5,4) = q$(i,j)
15010 i = s6+2 : v$(5,3) = q$ : if i < 11 then v$(5,3) = q$(i,s7)
15020 i = s6+1 : v$(4,3) = q$ : if i < 11 then v$(4,3) = q$(i,s7)
15030 n = n+1 : if n = 3 then 15140
15040 i = s6+2 : j = s7-1 : v$(5,2) = q$ : if (i < 11) and (j > 0) then v$(5,2) = q$(i,j)
15050 i = s6+2 : j = s7-2 : v$(5,1) = q$ : if (i < 11) and (j > 0) then v$(5,1) = q$(i,j)
15060 i = s6+1 : j = s7-1 : v$(4,2) = q$ : if (i < 11) and (j > 0) then v$(4,2) = q$(i,j)
15070 n = n+1 : if n = 3 then 15140
15080 j = s7-2 : v$(4,1) = q$ : if (i < 11) and (j > 0) then v$(4,1) = q$(i,j)
15090 j = s7-2 : v$(3,1) = q$ : if j > 0 then v$(3,1) = q$(s6,j)
15100 j = s7-1 : v$(3,2) = q$ : if j > 0 then v$(3,2) = q$(s6,j)
15110 n = n+1 : if n = 3 then 15140
15120 i = s6-1 : j = s7-2 : v$(2,1) = q$ : if (i > 0) and (j > 0) then v$(2,1) = q$(i,j)
15130 goto 14810
15140 for i = 1 to 5
15150 if (v$(i,1) = " ") and (v$(i,3) = " ") and (v$(i,5) = " ") then 15180
15160 print " ";
15170 for j = 1 to 5 : print v$(i,j);" "; : next j : print
15180 next i : return
15190 rem - WAIT
15200 j3 = 0 : input "HOW MANY STARDATES ";z5
15210 if (z5 < r5) and (k3 = 0) then 15230
15220 input "ARE YOU SURE? ";b$ : if left$(b$,1) <> "Y" then return
15230 r6 = 1
15240 if z5 <= 0 then r6 = 0
15250 if r6 = 0 then return
15260 t1 = z5 : z6 = z5
15270 if k3 = 0 then 15300
15280 t1 = 1+rnd(1) : if z5 < t1 then t1 = z5
15290 z6 = t1
15300 if t1 < z5 then gosub 1520
15310 if a2 <> 0 then return
15320 gosub 4760 : j3 = 1 : if a2 <> 0 then return
15330 z5 = z5-z6 : goto 15240
15340 rem:WARP
15350 j3 = 0 : if d4(6) <> 0 then 15820
15360 input "ENTER COURSE AND DISTANCE ";d2,d1
15370 if d2 < 0 then return
15380 p = (d1+0.05)*w1*w1*w1*(s4+1) : if p < e1 then 15500
15390 j3 = 0 : print : print "ENGINEERING TO BRIDGE--"
15400 if (s4 = 0) or (0.5*p > e1) then 15430
15410 print " WE HAVEN'T THE ENERGY TO GO THAT FAR WITH ";
15420 print " THE SHIELDS UP." : return
15430 w = int((e1/(d1+0.05))^0.333333) : if w <= 0 then 15480
15440 print " WE HAVEN'T THE ENERGY. BUT WE COULD DO IT AT WARP ";w
15450 if s4 <> 0 then 15470
15460 return
15470 print "  IF YOU'LL LOWER THE SHIELDS." : return
15480 print " WE CAN'T DO IT, CAPTAIN. WE HAVEN'T GOT THE ENERGY."
15490 return
15500 t1 = 10*d1/w2 : if t1 < 0.8*r5 then 15560
15510 print : print "MR. SPOCK - 'CAPTAIN, I COMPUTE THAT SUCH A TRIP"
15520 print " WILL REQUIRE APPROXIMATELY ";fnr(100*t1/r5);
15530 print "PERCENT" : print "  OF OUR REMAINING TIME. ARE YOU SURE ";
15540 input "THIS IS WISE ";b$ : if left$(b$,1) = "Y" then 15560
15550 j3 = 0 : return
15560 q4 = 0 : w = 0 : if w1 <= 6 then 15720
15570 p = d1*(6-w1)^2/66.66666 : if p > rnd(1) then q4 = 1
15580 if q4 <> 0 then d1 = rnd(1)*d1
15590 w = 0 : if w1 < 10 then 15610
15600 if 0.25*d1 > rnd(1) then w = 1
15610 if (q4 = 0) and (w = 0) then 15720
15620 a = (15-d2)*0.5236 : x1 = -sin(a) : x2 = cos(a)
15630 b8 = abs(x1) : if abs(x2) > abs(x1) then b8 = abs(x2)
15640 x1 = x1/b8 : y1 = y1/b8 : n = int(10*d1*b8+0.5) : x = s6 : y = s7
15650 if n = 0 then 15720
15660 for l = 1 to n
15670 x = x+x1 : q = int(x+0.5) : if (q < 1) or (q > 10) then 15720
15680 y = y+y1 : r = int(y+0.5) : if (r < 1) or (r > 10) then 15720
15690 if q$(q,r) = "." then 15710
15700 q4 = 0 : w = 0
15710 next l
15720 gosub 8000 : if a2 <> 0 then return
15730 e1 = e1-d1*w1*w1*w1*(s4+1) : if e1 > 0 then 15750
15740 f9 = 4 : gosub 5940 : return
15750 t1 = 10*d1/w2 : if w <> 0 then gosub 14270
15760 if q4 = 0 then 15810
15770 print : print "ENGINEERING TO BRIDGE--" : print "  SCOTT HERE- ";
15780 print "'WE'VE JUST BLOWN THE WARP ENGINES."
15790 print "  WE'LL HAVE TO SHUT 'ER DOWN HERE, CAPTAIN.'"
15800 d4(6) = d5*(3*rnd(1)+1)
15810 j3 = 1 : return
15820 print "WARP ENGINES DAMAGED." : return
15830 rem - ABANDON
15840 on sgn(d4(10))+2 goto 15850,15870,15860
15850 print "YE FAERIE QUEENE HAS NO SHUTTLE CRAFT." : return
15860 print "SHUTTLE CRAFT DAMAGED." : return
15870 print : print "***ABANDON SHIP! ABANDON SHIP!"
15880 print "***ALL HANDS ABANDON SHIP!" : print
15890 print "YOU AND THE BRIDGE CREW ESCAPE IN THE GALILEO."
15900 print "THE REMAINDER OF THE CREW BEAMS DOWN"
15910 print "TO THE NEAREST HABITABLE PLANET." : if r3 <> 0 then 15930
15920 f9 = 9 : gosub 5940 : return
15930 print : print "YOU ARE CAPTURED BY KLINGONS AND RELEASED TO "
15940 print "THE FEDERATION IN A PRISONER-OF-WAR EXCHANGE."
15950 print "STARFLEET PUTS YOU IN COMMAND OF ANOTHER SHIP,"
15960 print "THE FAERIE QUEENE WHICH IS ANTIQUATED, BUT"
15970 print "STILL USABLE." : n = int(rnd(1)*r3+1) : q1 = b2(n) : q2 = b3(n)
15980 s6 = 5 : s7 = 5 : gosub 9500 : q$(s6,s7) = "."
15990 for l = 1 to 3 : s6 = int(3*rnd(1)-1+b6)
16000 if (s6 < 1) or (s7 > 10) then 16030
16010 s7 = int(3*rnd(1)-1+b7) : if (s7 < 1) or (s7 > 10) then 16030
16020 if q$(s6,s7) = "." then 16040
16030 next l : goto 15980
16040 s5$ = "FAERIE QUEENE" : q$(s6,s7) = left$(s5$,1) : c5$ = "DOCKED"
16050 for l = 1 to 12 : d4(l) = 0 : next : d4(10) = -1 : e1 = 3000 : i7 = e1
16060 s3 = 1500 : i8 = s3 : t4 = 6 : i9 = t4 : l1 = 3 : j1 = l1 : s4 = 0 : w1 = 5 : w2 = 25
16070 return
16080 rem - DESTRUCT
16090 if d4(11) = 0 then 16120
16100 print "COMPUTER DAMAGED - CANNOT EXECUTE DESTRUCT SEQUENCE"
16110 return
16120 print : print "  ---WORKING---"
16130 print "IDENT IF ICATION-POSITIVE"
16140 print "SELF-DESTRUCT-SEQUENCE-ACTIVATED" : j = 3
16150 for i = 10 to 6 step -1 : print spc$(j);i : gosub 16300 : j = j+3 : next
16160 print "ENTER-YOUR-MISSION-PASSWORD-TO -CONTINUE"
16170 print "SELF-DESTRUCT-SEQUENCE-OTHERWISE-DESTRUCT"
16180 print "SEQUENCE-WILL-BE-ABORTED"
16190 input b$ : if b$ <> x$ then 16280
16200 print "PASSWORD-ACCEPTED" : j = 10
16210 for i = 5 to 1 step -1 : print spc$(j);i : gosub 16300 : j = j+3 : next
16220 print : print "*****ENTROPY OF ";s5$;" MAXIMIZED*****"
16230 print : if k3 = 0 then 16270
16240 w = 20*e1 : for l = 1 to k3 : if k6(l)*k7(l) > w then 16260
16250 a5 = k4(l) : a6 = k5(l) : t2$ = q$(a5,a6) : gosub 4220
16260 next l
16270 f9 = 10 : gosub 5940 : return
16280 print "PASSWORD-REJECTED"
16290 print "CONTINUITY-EFFECTED" : print : return
16300 k = 12345 : for m = 1 to 90 : k = k+1 : next m : return
16310 rem - STATUS
16320 for i = 1 to 10 : goto 14060 : return
16330 bye : end
16340 rem rhn fixup
16350 dim spc$(40)
16360 for j = 1 to 40 : spc$(j) = ""
16370 for i = 1 to j : spc$(j) = spc$(j)+" " : next i : next j
16380 return

