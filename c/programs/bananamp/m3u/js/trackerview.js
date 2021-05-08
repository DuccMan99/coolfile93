var trackerview = function(div, canvas, ctx) {

  var modData = this.playerData;
  // console.log(modData);
  if (!modData.patterns) return;

  // console.log(this);

  // based on https://github.com/jhalme/webaudio-mod-player

  //div.setAttribute('style', 'overflow: auto');

  var
    patt = modData.patterns,
    pHTML = ''
  ;
  for (var p = 0, l = patt.length; p < l; p++) {
    pHTML += '<div class="patterndata" id="pattern"'+p+'">';
    for(var r = 0; r < 64; r++) {
      pHTML += '<div class="patternrow" id="pattern'+p+'_row'+r+'">|'+patt[p].hexa+"|"+patt[p].rows[r].hexa+"|";
      for(var c = 0, cl = patt[p].rows[r].channels.length; c < cl; c++) {
        var ch = patt[p].rows[r].channels[c];
        pHTML += ch.note ?   '<span class="note">' + ch.note + ' </span>' : '... ';
        pHTML += ch.sample ? '<span class="sample">' + ch.sample + ' </span>' : '.. ';
        pHTML +=             '<span class="command">' + ch.command + '</span>|';
      }
      pHTML += '</div>';
    }
    pHTML += '</div>';
  }

  var
    samp = modData.samples,
    sHTML = '<div id="modsamples">'
  ;
  for (var i = 0, l = samp.length; i < l; i++) {
    sHTML +=
      '<div class="samplelist" id="sample'+i+'">'+
        '<span class="samplhexa">'+ modData.toHexa(i) +'</span>&nbsp;'+
        '<span class="samplenote">&nbsp;&nbsp;&nbsp;</span>&nbsp;'+
        '<span>'+ samp[i] +'</span>.'+
      '</div>'
    ;
  }
  sHTML += '</div>';

  div.innerHTML = '<div class="module_samples font_tomo skin_nerd">'+sHTML+'</div>' +
                  '<div class="module_patterns font_tomo skin_nerd">'+pHTML+'</div>';

  /////////////////////////////////////////////////////////////////////////////

  var oldpos=-1, oldrow=-1, rowEl, sampleEl;
  var mod = modData.player;
  var scrollMiddle = this.height / 2;

  return {
    // return the render function called in an requestAnimationFrame loop
    render: function() {

      // console.log(modData);
      // return

      if (mod.paused) return;

      if (oldrow != mod.row) {

        // sample highlight
        /////////////////////////////////////////////////////////////////////////////
        var activesamples = document.querySelectorAll('.activenote');
        for (var i = 0, l = activesamples.length; i < l; i++) {
          activesamples[i].className = 'samplelist';
        }
        for (var c = 0; c < mod.channels; c++) {
          var ch = modData.patterns[mod.patterntable[mod.position]].rows[mod.row].channels[c];
          if (mod.channel[c].noteon) {
            sampleEl = document.getElementById("sample"+(mod.channel[c].sample));
            if (sampleEl) {
              sampleEl.classList.add('activenote');
              if (ch.note) sampleEl.classList.add('activesample');
              sampleEl.querySelector('.samplenote').innerHTML = modData.getNote(mod.channel[c].note);
            };
          }
        }

        // row highlight
        /////////////////////////////////////////////////////////////////////////////
        // rowEl = document.querySelector('.currentpattern');
        // if (rowEl) {rowEl.classList.remove('currentpattern');}
        rowEl = document.querySelector('.currentrow');
        if (rowEl) {rowEl.classList.remove('currentrow');}
        rowEl = document.getElementById("pattern"+mod.patterntable[mod.position]+"_row"+mod.row);
        if (rowEl) {
          if (rowEl.parentNode) rowEl.parentNode.classList.add('currentpattern');
          rowEl.classList.add('currentrow');
          div.scrollTop = rowEl.offsetTop - scrollMiddle;
        }
        oldpos=mod.position;
        oldrow=mod.row;
      }

    }
  }
}
