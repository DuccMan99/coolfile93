<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1" />
  <title>filter</title>

  <meta name="description" content="hug + hack = infinity">
  <meta name="author" content="jankenpopp, zombectro">
  <meta http-equiv="Content-Language" content="en_US" />
  <meta name="google" content="notranslate" />
  <link href="/rss" rel="alternate" type="application/rss+xml" title="windows93" />
  <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico?v=2.4.2" />

  <link rel="stylesheet" href="/c/sys42.css?v=2.4.2">
  <link rel="stylesheet" href="/c/sys/skins/w93.css?v=2.4.2" id="w93_skin">
  <link rel="stylesheet" href="/sys/hotfix.css?v=2.4.2"></head>

<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

<body class="skin_alpha">
  <div class="ui_layout">
    <header style="flex: 0 150px;">
      <div id="preview_cont">
        <h1>Donation <span id="preview">Jacques Henri</span> Lartigue</h1>
      </div>
    </header>
    <section>
      <div class="ui_layout">
        <section>
          <textarea id="code" name="code">
          <circle id="cornea" cx="100" cy="100" r="50" fill="url(#corneaSurface)"/>
          <radialGradient id="corneaSurface">
            <stop offset="0%"   stop-color="black" stop-opacity="1"/>
            <stop offset="100%" stop-color="black" stop-opacity="0"/>
          </radialGradient>

          <feGaussianBlur stdDeviation="3"  in="SourceAlpha" />
            <feOffset dx="0" dy="0"           result="offsetblur"/>
            <feFlood flood-color="#ced237"/>
            <feComposite operator="in" in2="offsetblur"/>
            <feMerge>

              <feMergeNode/>
              <feMergeNode                    in="cornea"/>
              <feMergeNode                    in="SourceGraphic"/>
            </feMerge>
          </textarea>
        </section>
        <header>
          <select name="" id="fx"></select>
        </header>
      </div>
    </section>

  </div>




  <svg id="svg_fx" version="1.1" xmlns="http://www.w3.org/2000/svg">
<defs>

<filter id="fx_neon_satan" style="color-interpolation-filters:sRGB">
  <feGaussianBlur stdDeviation="0.8" result="blur" id="feGaussianBlur4700"></feGaussianBlur>
  <feComponentTransfer in="blur" result="component" id="feComponentTransfer4702">
    <feFuncR type="table" tableValues="0 1 0 1 1" id="feFuncR4704"></feFuncR>
    <feFuncG type="table" tableValues="0 0 0 1 1" id="feFuncG4706"></feFuncG>
    <feFuncB type="table" tableValues="0 0 0 1 1" id="feFuncB4708"></feFuncB>
  </feComponentTransfer>
</filter>

<filter id="fx_neon_slug" style="color-interpolation-filters:sRGB">
  <feGaussianBlur stdDeviation="0.8" result="blur" id="feGaussianBlur4700"></feGaussianBlur>
  <feComponentTransfer in="blur" result="component" id="feComponentTransfer4702">
    <feFuncR type="table" tableValues="0 1 0 1 1" id="feFuncR4704"></feFuncR>
    <feFuncG type="table" tableValues="1 0 1 1 1" id="feFuncG4706"></feFuncG>
    <feFuncB type="table" tableValues="-4 2 0 1 1" id="feFuncB4708"></feFuncB>
  </feComponentTransfer>
</filter>

<filter id="fx_neon_hulk" style="color-interpolation-filters:sRGB">
  <feGaussianBlur stdDeviation="0.8" result="blur" id="feGaussianBlur4700"></feGaussianBlur>
  <feComponentTransfer in="blur" result="component" id="feComponentTransfer4702">
    <feFuncR type="table" tableValues="0 1 0 1 1" id="feFuncR4704"></feFuncR>
    <feFuncG type="table" tableValues="0 1 0 1 1" id="feFuncG4706"></feFuncG>
    <feFuncB type="table" tableValues="0 0 0 1 1" id="feFuncB4708"></feFuncB>
  </feComponentTransfer>
</filter>

<filter id="fx_displacement" >
  <feOffset dy="21" dx="0" result="offset2"></feOffset>
  <feDisplacementMap scale="42" in2="offset2" xChannelSelector="R"></feDisplacementMap>
</filter>


<filter id="fx_aqua" inkscape:menu="Image Paint and Draw" style="color-interpolation-filters:sRGB" inkscape:label="Litho" inkscape:menu-tooltip="Create a two colors lithographic effect">
  <feGaussianBlur stdDeviation="1" in="SourceGraphic" result="result0"></feGaussianBlur>
  <feTurbulence result="result1" numOctaves="1" seed="488" baseFrequency="0.095" type="turbulence"></feTurbulence>
  <feComposite in="result0" in2="result1" operator="in" result="result2"></feComposite>

  <feBlend mode="multiply" result="fbSourceGraphic" in2="result91"></feBlend>
  <feColorMatrix result="fbSourceGraphicAlpha" in="fbSourceGraphic" values="0 0 0 0 0 0 0 1 0 0 0 0 1 0 0 0 0 0 5 0"></feColorMatrix>
  <feGaussianBlur result="result0" in="fbSourceGraphicAlpha" stdDeviation="3"></feGaussianBlur>

  <feSpecularLighting specularExponent="30" specularConstant="1.2" surfaceScale="1" lighting-color="rgb(111,236,253)" result="result1" in="result0">
  <fePointLight z="20000" y="-10000" x="-5000"></fePointLight>
  </feSpecularLighting>
  <feComposite k2="-1" operator="in" result="result2" in="result1" in2="fbSourceGraphicAlpha"></feComposite>
  <feComposite k3="1" k2="3" operator="arithmetic" result="result4" in="fbSourceGraphic" in2="result2"></feComposite>
  <feBlend mode="multiply" in2="result4"></feBlend>
</filter>


<filter id="fx_litho" inkscape:menu="Image Paint and Draw" style="color-interpolation-filters:sRGB" inkscape:label="Litho" inkscape:menu-tooltip="Create a two colors lithographic effect">
  <feGaussianBlur stdDeviation="0.01"></feGaussianBlur>
  <feColorMatrix result="fbSourceGraphic" in="fbSourceGraphic" values="0.21 0.72 0.072 0 0 0.21 0.72 0.072 0 0 0.21 0.72 0.072 0 0 0 0 0 50 0 "></feColorMatrix>
  <feComponentTransfer result="fbSourceGraphic" in="fbSourceGraphic">
  <feFuncR type="discrete" tableValues="0 1 1"></feFuncR>
  <feFuncG type="discrete" tableValues="0 1 1"></feFuncG>
  <feFuncB type="discrete" tableValues="0 1 1"></feFuncB>
  </feComponentTransfer>
</filter>

<filter id="fx_trichrome" inkscape:menu="Color" inkscape:menu-tooltip="Like Duochrome but with three colors" inkscape:label="Trichrome" style="color-interpolation-filters:sRGB;">
  <feColorMatrix values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 -0.21 -0.72 -0.07 1 0 " result="result1" />
  <feColorMatrix result="result3" values="1 0 0 0 0 0 1 0 0 0 0 0 1 0 0 0 0 0 2 -1 " />
  <feColorMatrix values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.21 0.72 0.07 0 0 " in="SourceGraphic" result="result2" />
  <feColorMatrix result="result9" values="1 0 0 0 0 0 1 0 0 0 0 0 1 0 0 0 0 0 1.5 -0.5 " />
  <feMerge result="result11">
  <feMergeNode in="result3" />
  <feMergeNode in="result9" />
  </feMerge>
  <feFlood flood-opacity="1" flood-color="rgb(186,22,91)" result="result10" />
  <feComposite in2="result11" result="result12" operator="out" />
  <feFlood flood-opacity="1" result="result13" flood-color="rgb(1,171,171)" />
  <feComposite in2="result3" result="result14" operator="in" />
  <feComposite in2="result12" result="result17" k3="1" k2="1" operator="arithmetic" />
  <feFlood flood-opacity="1" result="result15" flood-color="rgb(255,255,0)" />
  <feComposite in2="result9" result="result16" operator="in" />
  <feComposite in2="result17" result="result18" k3="1" k2="1" operator="arithmetic" />
  <feComposite in2="SourceGraphic" operator="in" />
</filter>
<!--
/////////////////////////////////////////////////////////////////////////////
 -->


     <!--
     http://electricbeach.org/?p=950
     http://codepen.io/awgreenblatt/pen/Kdsfr
     -->

 <!-- <filter id="fx_none">
 </filter> -->


<!-- <filter id="fx_vhs2">
  <feConvolveMatrix order="3" kernelMatrix="1 -1  1 -1 -0.01 -1 1 -1 1" edgeMode="duplicate" result="convo">
  </feConvolveMatrix>
</filter> -->

<filter id="fx_convo">
  <feConvolveMatrix order="3" kernelMatrix="1 -1  1 -1 -0.01 -1 1 -1 1" edgeMode="duplicate" result="convo">
  </feConvolveMatrix>
</filter>

<filter id="fx_convo2">
  <feConvolveMatrix order="3 3" kernelMatrix="2 -1  1 -1 -0.01 -1 1 -1 0"></feConvolveMatrix>
</filter>

<filter id="fx_convo3">
  <feConvolveMatrix style="color-interpolation-filters:sRGB" order="3" kernelMatrix="0 -0.9 0   -1 4 -1   0 -1 0" preserveAlpha="true"></feConvolveMatrix>
</filter>

<filter id="fx_convo4">
  <feConvolveMatrix style="color-interpolation-filters:sRGB" order="3" kernelMatrix="0 -1 0   -1 4 -1   0 -1.1 0" preserveAlpha="true"></feConvolveMatrix>
</filter>

<filter id="fx_convoblur">
  <feGaussianBlur in="SourceGraphic" stdDeviation="6" result="blur"/>
  <feConvolveMatrix order="3" kernelMatrix="1 -1  1 -1 -0.01 -1 1 -1 1" edgeMode="none" result="convo"/>
  <feMerge>
  <feMergeNode in="blur"/>
  <feMergeNode in="convo"/>
  </feMerge>
</filter>

<filter id="fx_postor">
  <feComponentTransfer>
    <feFuncR type="discrete" tableValues="0 1.4 -5.3 -1.8 -5.2 1"></feFuncR>
    <feFuncG type="discrete" tableValues="0 -5.7 0.4 5.6 0.8 1"></feFuncG>
    <feFuncB type="discrete" tableValues="0 0.2 0.4 0.6 -1.7 1"></feFuncB>
  </feComponentTransfer>
</filter>

<filter id="fx_postilt">
  <feComponentTransfer>
    <feFuncR type="discrete" tableValues="0 21.4 0 0 0 1"></feFuncR>
    <feFuncG type="discrete" tableValues="0 133.4 0 1 0 1"></feFuncG>
  </feComponentTransfer>
</filter>

<filter id="fx_postel">
  <feComponentTransfer>
    <feFuncR type="discrete"
        tableValues="0.1 3.1 11 0.6 -10.2 13.8"/>
    <feFuncG type="discrete"
        tableValues="0.2 1.5 0.4 9 4.7 8.2"/>
    <feFuncB type="discrete"
        tableValues="0.9 -0.2 0.4 -9.7 0.8 1"/>
  </feComponentTransfer>
</filter>

<filter id="fx_orton">
  <feColorMatrix type="matrix" in="SourceGraphic" result="brighter"
    values="5.1 0 0 0 0.1
            0 5.1 0 0 0.1
            0 0 5.1 0 0.1
            0 0 0 1 0"/>
      <feGaussianBlur in="brighter" stdDeviation="3" result="brightblur"/>
  <feBlend mode="multiply" in="brighter" in2="brightblur"/>
</filter>

<filter id="fx_santabarbara">
  <feColorMatrix type="luminanceToAlpha" in="SourceGraphic" result="lumMap"></feColorMatrix>
  <feComponentTransfer in="lumMap" result="highlightMask">
    <feFuncA type="discrete" tableValues="0 0 0 0 0 0 7 6"/>
  </feComponentTransfer>
  <feComposite operator="in" in="SourceGraphic" in2="highlightMask" result="highlights"></feComposite>
  <feGaussianBlur in="highlights" stdDeviation="6" result="highBlur"></feGaussianBlur>
  <feComposite operator="over" in="highBlur" in2="SourceGraphic" result="final"></feComposite>
</filter>

<filter id="fx_santabarbara2" inkscape:label="Soft Focus Lens" inkscape:menu="Image Effects" inkscape:menu-tooltip="Glowing image content without blurring it" style="color-interpolation-filters:sRGB;">
  <feGaussianBlur stdDeviation="5" result="result3"></feGaussianBlur>
  <feColorMatrix values="1 0 0 0 0 0 1 0 0 0 0 0 1 0 0 0 0 0 28 0 " result="result7"></feColorMatrix>
  <feComposite operator="in" in2="SourceGraphic" result="result9"></feComposite>
  <feComposite in2="result7" operator="arithmetic" in="result9" k1="0.9" k3="0.9" result="result1"></feComposite>
  <feBlend in2="result1" result="result5" mode="screen" in="SourceGraphic"></feBlend>
  <feBlend in2="result5" mode="darken" in="result5" result="result6"></feBlend>
  <feComposite in2="SourceGraphic" operator="in" result="result8"></feComposite>
</filter>

<filter id="fx_spectrum">
  <feConvolveMatrix filterRes="100 100" style="color-interpolation-filters:sRGB" order="3" kernelMatrix="0 -1 0   -1 4 -1   0 -1 0" preserveAlpha="true" />
</filter>

<filter id="fx_zombi">
  <feFlood flood-color="#c3ff00" result="A" />
  <feColorMatrix type="matrix" in="SourceGraphic" result="B"
    values=" 1 0 0 0 0
             0 0 0 0 0
             0 1 1 0 0
             1 1 1 0 0" />
  <feMerge>
    <feMergeNode in="A" />
    <feMergeNode in="B" />
  </feMerge>
</filter>

<!-- <filter id="fx_sepiablue" x="0%" y="0%" width="100%" height="100%">
  <feColorMatrix type="matrix" values="0.2126 0.7152 0.0722 0 0 0.2126 0.7152 0.0722 0 0 0.2126 0.7152 0.0722 0 0 0 0 0 1 0"/>
  <feComponentTransfer >
    <feFuncR type="table" tableValues="0 0 0.1 1"/>
    <feFuncG type="table" tableValues="0 .1 0.4 1"/>
    <feFuncB type="table" tableValues="0 .2 .4 1"/>
  </feComponentTransfer>
</filter> -->

<filter id="fx_blueray" x="0%" y="0%" width="100%" height="100%">
  <feColorMatrix type="matrix" in="SourceGraphic" result="B"
    values=" -1 0 0 0 -1
             0 -1 0 0 -1
             -.1 1 -.1 0 0
             0 -.1 -.2 1 0" />
</filter>

<filter id="fx_hip">
  <feColorMatrix type="matrix" in="SourceGraphic"
    values=" -1 0 0 0 0
             0 1 0 0 0
             0 -1 1 0 0
             0 0 0 1 0" />
</filter>


<filter id="fx_xray">
  <feColorMatrix type="luminanceToAlpha" values=""/>
</filter>

<filter id="fx_emboss" >
  <feColorMatrix type="luminanceToAlpha" values=""/>
  <feDiffuseLighting diffuseConstant="1" surfaceScale="5" result="feDistantLight">
    <feDistantLight elevation="28" azimuth="65" />
  </feDiffuseLighting>
</filter>

<filter id="fx_edge">
  <feConvolveMatrix order="3 3" preserveAlpha="true" kernelMatrix="-5 0 0 0 0 0 0 0 5"/>
</filter>

<!-- <filter id="fx_noir">
  <feGaussianBlur stdDeviation="0" />
  <feComponentTransfer>
    <feFuncR type="discrete" tableValues="0 .5 1 1" />
    <feFuncG type="discrete" tableValues="0 .5 1" />
    <feFuncB type="discrete" tableValues="0" />
  </feComponentTransfer>
</filter> -->


<!-- inkscape -->

<filter id="fx_ripple" inkscape:label="Ripple" inkscape:menu="Distort" inkscape:menu-tooltip="Horizontal rippling of edges" style="color-interpolation-filters:sRGB;">
  <feTurbulence numOctaves="1" baseFrequency="0.002 0.107" />
  <feColorMatrix values="2 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.5 0.5" result="result91" />
  <feDisplacementMap yChannelSelector="A" xChannelSelector="R" scale="14.3" in="SourceGraphic" in2="result91" />
</filter>

<filter id="fx_sys42" style="color-interpolation-filters:sRGB;">
  <feColorMatrix values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 -0.21 -0.72 -0.07 1 0 " result="result1"></feColorMatrix>
  <feColorMatrix result="result3" values="1 0 0 0 0 0 1 0 0 0 0 0 1 0 0 0 0 0 2 -1 "></feColorMatrix>
  <feColorMatrix values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.21 0.72 0.07 0 0 " in="SourceGraphic" result="result2"></feColorMatrix>
  <feColorMatrix result="result9" values="1 0 0 0 0 0 1 0 0 0 0 0 1 0 0 0 0 0 1.5 -0.5 "></feColorMatrix>
  <feMerge result="result11">
  <feMergeNode in="result3"></feMergeNode>
  <feMergeNode in="result9"></feMergeNode>
  </feMerge>
  <feFlood flood-opacity="1" flood-color="rgb(204,255,0)" result="result10"></feFlood>
  <feComposite in2="result11" result="result12" operator="out"></feComposite>
  <feFlood flood-opacity="1" result="result13" flood-color="rgb(255,0,255)"></feFlood>
  <feComposite in2="result3" result="result14" operator="in"></feComposite>
  <feComposite in2="result12" result="result17" k3="1" k2="1" operator="arithmetic"></feComposite>
  <feFlood flood-opacity="1" result="result15" flood-color="rgb(0,255,255)"></feFlood>
  <feComposite in2="result9" result="result16" operator="in"></feComposite>
  <feComposite in2="result17" result="result18" k3="1" k2="1" operator="arithmetic"></feComposite>
  <feComposite in2="SourceGraphic" operator="in"></feComposite>
</filter>

<filter id="fx_vhs">
  <feFlood flood-opacity="1" flood-color="rgb(255,255,255)" result="flood"></feFlood>
  <feColorMatrix in="SourceGraphic" values="0 0 0 0 0 0 0 0 0 1 0 0 0 0 1 -1 0 0 1 0 " result="colormatrix1"></feColorMatrix>
  <feOffset dy="-1" dx="-3" result="offset1"></feOffset>
  <feBlend in2="flood" mode="multiply" result="blend1"></feBlend>
  <feColorMatrix in="SourceGraphic" values="0 0 0 0 1 0 0 0 0 0 0 0 0 0 1 0 -1 0 1 0 " result="colormatrix2"></feColorMatrix>
  <feOffset dy="2" dx="-1" result="offset2"></feOffset>
  <feBlend in2="blend1" mode="multiply" result="blend2"></feBlend>
  <feOffset dy="3" dx="-2" result="offset3"></feOffset>
  <feColorMatrix in="SourceGraphic" values="0 0 0 0 1 0 0 0 0 1 0 0 0 0 0 0 0 -1.5 1 0 " result="colormatrix3"></feColorMatrix>
  <feBlend in2="offset3" mode="multiply" result="blend3"></feBlend>
</filter>

<filter id="fx_vhs2">
  <feTurbulence numOctaves="1" baseFrequency="0.002 0.107"></feTurbulence>
  <feColorMatrix values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 5.5 -1.9" result="result91"></feColorMatrix>
  <feDisplacementMap yChannelSelector="A" xChannelSelector="R" scale="10" in="SourceGraphic" in2="result91" result="glitch"></feDisplacementMap>
  <feFlood flood-opacity="1" flood-color="rgb(255,255,255)" result="flood"></feFlood>
  <feColorMatrix in="glitch" values="0 0 0 0 0 0 0 0 0 1 0 0 0 0 1 -1 0 0 1 0 " result="colormatrix1"></feColorMatrix>
  <feOffset dy="-1" dx="-3" result="offset1"></feOffset>
  <feBlend in2="flood" mode="multiply" result="blend1"></feBlend>
  <feColorMatrix in="glitch" values="0 0 0 0 1 0 0 0 0 0 0 0 0 0 1 0 -1 0 1 0 " result="colormatrix2"></feColorMatrix>
  <feOffset dy="2" dx="-1" result="offset2"></feOffset>
  <feBlend in2="blend1" mode="multiply" result="blend2"></feBlend>
  <feOffset dy="3" dx="-2" result="offset3"></feOffset>
  <feColorMatrix in="glitch" values="0 0 0 0 1 0 0 0 0 1 0 0 0 0 0 0 0 -1.5 1 0 " result="colormatrix3"></feColorMatrix>
  <feBlend in2="offset3" mode="multiply" result="blend3"></feBlend>
</filter>

<filter id="fx_anaglyph">
  <feFlood
     flood-opacity="1"
     flood-color="rgb(255,255,255)"
     result="flood"/>
  <feColorMatrix
     in="SourceGraphic"
     values="0 0 0 0 0 0 0 0 0 1 0 0 0 0 1 -1 0 0 1 0 "
     result="colormatrix1"/>
  <feOffset
     dy="0"
     dx="8"
     result="offset1"/>
  <feBlend
     in2="flood"
     mode="multiply"
     result="blend1"/>
  <feColorMatrix
     in="SourceGraphic"
     values="0 0 0 0 1 0 0 0 0 0 0 0 0 0 1 0 -1 0 1 0 "
     result="colormatrix2"/>
  <feBlend
     in2="blend1"
     mode="multiply"
     result="blend2"/>
  <feColorMatrix
     in="SourceGraphic"
     values="0 0 0 0 1 0 0 0 0 1 0 0 0 0 0 0 0 -1 1 0 "
     result="colormatrix3"/>
  <feBlend
     in2="blend2"
     mode="multiply"
     result="blend3"/>
</filter>

<filter
   style="color-interpolation-filters:sRGB;"
   inkscape:label="Electrize"
   id="fx_electrize">
  <feGaussianBlur
     stdDeviation="1"
     result="blur"
     id="feGaussianBlur4700" />
  <feComponentTransfer
     in="blur"
     result="component"
     id="feComponentTransfer4702">
    <feFuncR
       type="table"
       tableValues="0 1 0 1 0"
       id="feFuncR4704" />
    <feFuncG
       type="table"
       tableValues="0 1 0 1 0"
       id="feFuncG4706" />
    <feFuncB
       type="table"
       tableValues="0 1 0 1 0"
       id="feFuncB4708" />
  </feComponentTransfer>
</filter>

<filter
   style="color-interpolation-filters:sRGB;"
   inkscape:menu="Image Paint and Draw"
   inkscape:label="Poster Color Fun"
   id="fx_poster_color_fun">
  <feColorMatrix
     type="hueRotate"
     values="0"
     result="result4"
     id="feColorMatrix4763" />
  <feColorMatrix
     result="result7"
     type="saturate"
     values="1"
     id="feColorMatrix4765" />
  <feGaussianBlur
     stdDeviation="1.5"
     result="result3"
     id="feGaussianBlur4767" />
  <feGaussianBlur
     result="result5"
     stdDeviation="1.5"
     in="result7"
     id="feGaussianBlur4769" />
  <feBlend
     in2="result3"
     mode="normal"
     id="feBlend4771" />
  <feComponentTransfer
     result="result1"
     id="feComponentTransfer4773">
    <feFuncR
       tableValues="0 0.5 1 0.5 0 0.5 1 0.5"
       type="discrete"
       id="feFuncR4775" />
    <feFuncG
       tableValues="0 0.5 1 0.5 0 0.5 1 0.5"
       type="discrete"
       id="feFuncG4777" />
    <feFuncB
       tableValues="0 0.5 1 0.5 0 0.5 1 0.5"
       type="discrete"
       id="feFuncB4779" />
  </feComponentTransfer>
  <feColorMatrix
     type="hueRotate"
     values="0"
     id="feColorMatrix4781" />
  <feColorMatrix
     type="saturate"
     values="1"
     result="result2"
     id="feColorMatrix4783" />
  <feGaussianBlur
     stdDeviation="0.01"
     id="feGaussianBlur4785" />
  <feComposite
     in2="SourceGraphic"
     operator="in"
     result="result6"
     id="feComposite4787" />
</filter>

<!-- <filter id="fx_bump" inkscape:menu-tooltip="Same as HSL Bumps but with transparent highlights" inkscape:menu="Bumps" inkscape:label="HSL Bumps Alpha" style="color-interpolation-filters:sRGB;">
  <feGaussianBlur result="result0" in="SourceGraphic" stdDeviation="0.5" />
  <feColorMatrix values="1 0 0 -1 0 1 0 1 -1 0 1 0 0 -1 0 -0.8 -1 0 4.4 -2.9 " in="result0" result="fbSourceGraphicAlpha" />
  <feGaussianBlur stdDeviation="0.7" in="fbSourceGraphicAlpha" result="result0" />
  <feSpecularLighting in="result0" result="result1" lighting-color="rgb(255,255,255)" surfaceScale="-2" specularConstant="1.5" specularExponent="10">
  <feDistantLight elevation="50" azimuth="235" />
  </feSpecularLighting>
  <feComposite result="result4" operator="in" in="SourceGraphic" in2="result1" />
  <feComposite operator="arithmetic" k2="1" k3="1" in2="result4" />
</filter> -->

<filter id="fx_dark_emboss" inkscape:label="Dark Emboss" inkscape:menu-tooltip="Emboss effect : 3D relief where white is replaced by black" inkscape:menu="Bumps" style="color-interpolation-filters:sRGB;">
  <feColorMatrix result="result2" type="luminanceToAlpha" />
  <feDiffuseLighting diffuseConstant="0.5" result="result1" surfaceScale="-10">
  <feDistantLight elevation="20" azimuth="225" />
  </feDiffuseLighting>
  <feComposite result="result3" k3="1" k2="1" k1="1" in="result1" operator="arithmetic" in2="SourceGraphic" />
  <feBlend result="result4" mode="multiply" in="result2" in2="result3" />
  <feComposite result="result5" operator="arithmetic" k2="1.2" in2="result4" />
  <feComposite operator="in" in="result5" in2="SourceGraphic" />
</filter>

<filter id="fx_onebit" inkscape:label="Image Drawing Basic" style="color-interpolation-filters:sRGB;" inkscape:menu-tooltip="Enhance and redraw color edges in 1 bit black and white" inkscape:menu="Image Paint and Draw" >
  <feColorMatrix type="saturate" values="0" result="result4" />
  <feConvolveMatrix order="3 3" kernelMatrix="0 50 0 50 -205 50 0 50 0 " in="result4" divisor="1" targetX="1" targetY="1" preserveAlpha="true" result="result0" bias="0" />
  <feColorMatrix result="result3" values="0 -100 0 0 1 0 -100 0 0 1 0 -100 0 0 1 0 0 0 1 0 " />
</filter>

<filter id="fx_poster_draw" inkscape:label="Poster Draw" inkscape:menu="Image Paint and Draw" inkscape:menu-tooltip="Enhance and redraw edges around posterized areas" style="color-interpolation-filters:sRGB;">
  <feGaussianBlur in="SourceGraphic" result="result18" stdDeviation="1.4"></feGaussianBlur>
  <feColorMatrix values="0" result="result17" in="result19" type="hueRotate"></feColorMatrix>
  <feComponentTransfer in="result17" result="component1">
  <feFuncR type="discrete" tableValues="0 0.125 0.25 0.275 0.5 0.625 0.750 0.875 1 1"></feFuncR>
  <feFuncG type="discrete" tableValues="0 0.125 0.25 0.275 0.5 0.625 0.750 0.875 1 1"></feFuncG>
  <feFuncB type="discrete" tableValues="0 0.125 0.25 0.275 0.5 0.625 0.750 0.875 1 1"></feFuncB>
  </feComponentTransfer>
  <feColorMatrix type="saturate" values="0" result="result4" in="component1"></feColorMatrix>
  <feConvolveMatrix order="3 3" kernelMatrix="250 0 250 0 -1005 0 250 0 250 " in="result4" divisor="1" targetX="1" targetY="1" preserveAlpha="true" result="result0" bias="0"></feConvolveMatrix>
  <feColorMatrix type="luminanceToAlpha"></feColorMatrix>
  <feGaussianBlur stdDeviation="0.7"></feGaussianBlur>
  <feColorMatrix values="1 0 0 0 0 0 1 0 0 0 0 0 1 0 0 0 0 0 10 -4 " result="result5"></feColorMatrix>
  <feGaussianBlur stdDeviation="0.5" result="result10"></feGaussianBlur>
  <feColorMatrix values="1 0 0 0 0 0 1 0 0 0 0 0 1 0 0 0 0 0 15 -1.5 " result="result14"></feColorMatrix>
  <feFlood flood-color="rgb(124,0,60)" result="result8" flood-opacity="0.8"></feFlood>
  <feBlend result="result16" mode="screen" in2="component1"></feBlend>
  <feComposite in2="result14" operator="out" result="result6" in="result16"></feComposite>
  <feComposite in2="result14" operator="in" in="result9" result="result7"></feComposite>
  <feComposite in2="result6" result="result11" operator="arithmetic" k2="1" k3="1" in="SourceGraphic"></feComposite>
</filter>

<filter id="fx_square" inkscape:label="Cubes" inkscape:menu="Scatter" inkscape:menu-tooltip="Scattered cubes; adjust the Morphology primitive to vary size" style="color-interpolation-filters:sRGB;">
<feTurbulence baseFrequency="0.7" numOctaves="1" type="fractalNoise"></feTurbulence>
    <feColorMatrix values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 6 -3.5 " result="result5"></feColorMatrix>
    <feComposite in2="result5" operator="in" in="SourceGraphic" result="result6"></feComposite>
    <feMorphology result="result3" radius="5" operator="dilate" in="result6"></feMorphology>
    <feComposite in2="result4" operator="arithmetic" result="result2" k1="1" k3="1"></feComposite>
    <feConvolveMatrix order="3 3" kernelMatrix="2 0 0 0 1 0 0 0 -1 " targetX="0" targetY="0" divisor="2" edgeMode="duplicate"></feConvolveMatrix>
</filter>

<filter id="fx_plaster" inkscape:label="Plaster Color" inkscape:menu="Bumps" inkscape:menu-tooltip="Colored plaster emboss effect" style="color-interpolation-filters:sRGB;">
  <feGaussianBlur result="result10" stdDeviation="5" />
  <feGaussianBlur in="SourceGraphic" result="result4" stdDeviation="1.5" />
  <feBlend mode="darken" in2="result10" />
  <feComposite operator="atop" in2="SourceGraphic" result="result5" />
  <feColorMatrix type="saturate" values="0" result="result1" in="result5" />
  <feComponentTransfer result="component1" in="result1">
  <feFuncR type="table" tableValues="0 0.2 0.133333 0.3 0.4 0.333333 0.5 0.6 0.533333 0.7 0.8 0.733333 0.9 1 0.933333 1.1 1" />
  <feFuncG type="table" tableValues="0 0.2 0.133333 0.3 0.4 0.333333 0.5 0.6 0.533333 0.7 0.8 0.733333 0.9 1 0.933333 1.1 1" />
  <feFuncB type="table" tableValues="0 0.2 0.133333 0.3 0.4 0.333333 0.5 0.6 0.533333 0.7 0.8 0.733333 0.9 1 0.933333 1.1 1" />
  </feComponentTransfer>
  <feFlood flood-color="rgb(255,0,0)" result="result2" />
  <feBlend in2="component1" mode="screen" result="result2" in="result2" />
  <feBlend result="fbSourceGraphic" mode="multiply" in2="component1" />
  <feColorMatrix result="result2" type="luminanceToAlpha" in="fbSourceGraphic" />
  <feDiffuseLighting lighting-color="#ffffff" in="result2" diffuseConstant="1" result="result1" surfaceScale="15" >
  <feDistantLight azimuth="31" elevation="10" />
  </feDiffuseLighting>
  <feSpecularLighting specularExponent="10" in="result2" result="result11" surfaceScale="-15">
  <feDistantLight azimuth="225" elevation="45" />
  </feSpecularLighting>
  <feComposite operator="arithmetic" k2="0.5" k3="0.5" in2="result1" result="result12" />
  <feComposite in="result12" in2="fbSourceGraphic" result="result9" operator="arithmetic" k2="1" k3="1" />
  <feComposite in2="SourceGraphic" result="result7" operator="in" />
</filter>

<filter id="fx_fluorescence" inkscape:label="Fluorescence" inkscape:menu="Color" inkscape:menu-tooltip="Oversaturate colors which can be fluorescent in real world" style="color-interpolation-filters:sRGB;">
  <feColorMatrix type="hueRotate" values="18" />
  <feColorMatrix type="saturate" values="1" />
  <feColorMatrix type="matrix" values="2 -1 0 0 0 0 2 -1 0 0 -1 0 2 0 0 0 0 0 1 0 " />
</filter>

<filter id="fx_plasticine" inkscape:label="Plasticine" inkscape:menu="Bumps" inkscape:menu-tooltip="Matte modeling paste emboss effect" style="color-interpolation-filters:sRGB;">
  <feGaussianBlur result="result3" stdDeviation="2" in="SourceGraphic"></feGaussianBlur>
  <feComponentTransfer in="result3" result="result1">
  <feFuncR tableValues="0 0.1 0.2 0.3 0.4 0.5 0.6 0.7 0.8 0.9 1" type="discrete"></feFuncR>
  <feFuncG tableValues="0 0.1 0.2 0.3 0.4 0.5 0.6 0.7 0.8 0.9 1" type="discrete"></feFuncG>
  <feFuncB tableValues="0 0.1 0.2 0.3 0.4 0.5 0.6 0.7 0.8 0.9 1" type="discrete"></feFuncB>
  </feComponentTransfer>
  <feBlend in2="result1" mode="lighten" result="result6"></feBlend>
  <feColorMatrix result="result2" type="luminanceToAlpha" in="result6"></feColorMatrix>
  <feDiffuseLighting lighting-color="#ffffff" in="result2" diffuseConstant="1" result="result1" surfaceScale="12">
  <feDistantLight azimuth="225" elevation="25"></feDistantLight>
  </feDiffuseLighting>
  <feComposite in2="result6" k2="0.5" result="result3" k3="0.8" k1="0.2" in="result1" operator="arithmetic"></feComposite>
  <feComposite in2="SourceGraphic" result="result7" operator="in" k2="1" in="result3"></feComposite>
</filter>

  </defs>
</svg>


  <link rel="stylesheet" href="/c/libs/codemirror/lib/codemirror.css">
  <link rel="stylesheet" href="/c/libs/codemirror/theme/cobalt.css">
  <script src="/c/libs/codemirror/lib/codemirror.js"></script>
  <script src="/c/libs/codemirror/mode/xml/xml.js"></script>
  <script src="/c/libs/codemirror/mode/javascript/javascript.js"></script>
  <script src="/c/libs/codemirror/mode/css/css.js"></script>
  <script src="/c/libs/codemirror/mode/htmlmixed/htmlmixed.js"></script>
  <script src="./emmet.js"></script>

  <style>

    body {
      background: #1F1F1F;
    }

    #fx {
      width: 100%;
    }

    .CodeMirror {
      position: absolute;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
      width: auto;
      height: auto;

      background: #1F1F1F;
      color: #f8f8f8;

      font-family: "Tomo";
      font-size: 8px;
    }
    .CodeMirror-cursor { border-left: 1px solid #fff; }
    .CodeMirror-focused div.CodeMirror-selected,
    div.CodeMirror-selected {
      background: #0B0B0B;
    }

    .CodeMirror .cm-keyword { color: #a4ed2d; }
    .CodeMirror .cm-atom { color: #dd6988; }
    .CodeMirror .cm-number { color: #dd6988; }
    .CodeMirror .cm-def { color: #fff; }
    .CodeMirror .cm-keyword + span.cm-def { color: #f0562c; }
    .CodeMirror .cm-variable { color: #77ddbf; }
    .CodeMirror .cm-variable-2 { color: #fff; }
    .CodeMirror .cm-variable-3 { color: #2AD494; }
    .CodeMirror .cm-qualifier { color: #67c969; }
    .CodeMirror .cm-operator { color: #a4ed2d; }
    .CodeMirror .cm-property { color: #dd7758; }
    .CodeMirror .cm-comment { color: #316E96; /*#3D8686;*/ }
    .CodeMirror .cm-string { color: #ffd852; }
    .CodeMirror .cm-string-2 { color: #80ff82; }
    .CodeMirror .cm-meta { color: #D8FA3C; }
    .CodeMirror .cm-builtin { color: #f0562c; }
    .CodeMirror .cm-tag { color: #00e7e7; }
    .CodeMirror .cm-attribute { color: #8DA6CE; }
    .CodeMirror .cm-header { color: #FF6400; }
    .CodeMirror .cm-hr { color: #AEAEAE; }
    .CodeMirror .cm-link { color: #8DA6CE; }
    .CodeMirror .cm-error { color: #f06;}

    /* #preview {
      position: absolute;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
      width: auto;
      height: auto;
      background: #fff;
      padding: 3%;
    } */
    #preview_cont {
      text-align: center;
      position: absolute;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
      width: auto;
      height: 200px;
      background: #fff;
      padding: 3%;
    }

    h1 {
      font-family: 'Roboto';
      font-size: 500%;
      color: #000;
      /* color: #0ff; */
      /* text-shadow: 5px 5px 10px #f0f; */
    }
    h1 span {
      color: #ced237;
    }

  </style>
  <script>
    var delay;
    // Initialize CodeMirror editor with a nice html5 canvas demo.
    var editor = CodeMirror.fromTextArea(document.getElementById('code'), {
      mode: 'text/xml',
      profile: 'xhtml',
      lineWrapping: true
    });
    emmetCodeMirror(editor, {
      'Ctrl-Up': 'emmet.increment_number_by_1',
      'Ctrl-Down': 'emmet.decrement_number_by_1',
      'Shift-Ctrl-Up': 'emmet.increment_number_by_01',
      'Shift-Ctrl-Down': 'emmet.decrement_number_by_01',
    });
    editor.on("change", function() {
      clearTimeout(delay);
      delay = setTimeout(updatePreview, 10);
    });

    function updatePreview() {
      filter.innerHTML = editor.getValue()
      applyFilter()
    }
    setTimeout(updatePreview, 10);


    /////////////////////////////////////////////////////////////////////////////

    var svg = document.querySelector('svg')
    //console.log(svg.outerHTML)
    var filters = document.querySelectorAll('filter')
    var preview = document.getElementById('preview')
    var filter = document.getElementById('fx_convo')

    console.log(filter)

    /*var select = document.getElementById('fx')

    for (var i = 0, l = filters.length; i < l; i++) {
      select.appendChild(new Option(filters[i].id))
    }

    select.onchange = function() {
      filter = document.getElementById(this.value)
      editor.setValue(filter.innerHTML)
      //var filter = btoa(svg.outerHTML)
      //var url = 'data:image/svg+xml;utf8,'+filter+'#'+this.value
      applyFilter()
    }*/

    function applyFilter() {
      var url = 'data:image/svg+xml;utf8,' + btoa('<svg>' + filter.outerHTML + '</svg>') +'#'+filter.id
      preview.style.webkitFilter = preview.style.filter = "url('"+url+"')"
    }

    //select.onchange()

    setTimeout(function() {
      editor.refresh()
    }, 10);

  </script>

</body>
</html>