
//<![CDATA[
$(document).ready(function() {
	
	// homepage audio-player
	
	new jPlayerPlaylist({
		jPlayer: "#tr-player",
		cssSelectorAncestor: "#tr-player-wrapper"
	}, [
		{
			title:"Buja Fm Online",
			mp3:"http://104.248.46.139:8000/bujafm.mp3",
			oga:"http://104.248.46.139:8000/bujafm.mp3"
		},
		
            
        ], {
            swfPath: "assets/jplayer/jplayer",
            supplied: "oga, mp3",
            wmode: "window",
            useStateClassSkin: true,
            autoBlur: false,
            smoothPlayBar: true,
            keyEnabled: true,
            size: {width: "100%"}
        });
        // Show The Current Track !!
        $("#jplayer").on($.jPlayer.event.ready, function (event) {
            var current = myPlaylist.current;
            var playlist = myPlaylist.playlist;       
            $.each(playlist, function (index, obj) {
                if (index == current) {
                    $("#playing").html("<span class='artist-name'>" + obj.artist + "</span>" + "<br>" + "<span class='track-name'>" + obj.title + "</span>");
                }
            });
        });
        $("#jplayer").on($.jPlayer.event.play, function (event) {
            var current = myPlaylist.current;
            var playlist = myPlaylist.playlist;       
            $.each(playlist, function (index, obj) {
                if (index == current) {
                    $("#playing").html("<span class='artist-name'>" + obj.artist + "</span>" + "<br>" + "<span class='track-name'>" + obj.title + "</span>");
                }
            });
        });

    });//]]>



//<![CDATA[
    $(document).ready(function(){
    	// ========= About Page ==========
        $("#music").jPlayer({
            ready: function () {
                $(this).jPlayer("setMedia", {
                    mp3:"http://www.jplayer.org/audio/mp3/TSP-01-Cro_magnon_man.mp3",
                    oga:"http://www.jplayer.org/audio/ogg/TSP-01-Cro_magnon_man.ogg",
                });
            },
           
        });

        $("#music1").jPlayer({
            ready: function () {
                $(this).jPlayer("setMedia", {
                    mp3:"http://www.jplayer.org/audio/mp3/TSP-07-Cybersonnet.mp3",
                    oga:"http://www.jplayer.org/audio/ogg/TSP-07-Cybersonnet.ogg"
                });
            },
            cssSelectorAncestor: '#music-1'
        });

        $("#music2").jPlayer({
            ready: function () {
                $(this).jPlayer("setMedia", {
                    mp3:"http://www.jplayer.org/audio/mp3/Miaow-09-Partir.mp3",
                    oga:"http://www.jplayer.org/audio/ogg/Miaow-09-Partir.ogg"
                });
            },
            cssSelectorAncestor: '#music-2'
        });

        $("#music3").jPlayer({
            ready: function () {
                $(this).jPlayer("setMedia", {
                    mp3:"http://www.jplayer.org/audio/mp3/TSP-01-Cro_magnon_man.mp3",
                    oga:"http://www.jplayer.org/audio/ogg/TSP-01-Cro_magnon_man.ogg",
                });
            },
            cssSelectorAncestor: '#music-3'
        });

        $("#music4").jPlayer({
            ready: function () {
                $(this).jPlayer("setMedia", {
                    mp3:"http://www.jplayer.org/audio/mp3/TSP-05-Your_face.mp3",
                    oga:"http://www.jplayer.org/audio/ogg/TSP-05-Your_face.ogg"
                });
            },
            cssSelectorAncestor: '#music-4'
        });

        $("#music5").jPlayer({
            ready: function () {
                $(this).jPlayer("setMedia", {
                    mp3:"http://www.jplayer.org/audio/mp3/Miaow-08-Stirring-of-a-fool.mp3",
                    oga:"http://www.jplayer.org/audio/ogg/Miaow-08-Stirring-of-a-fool.ogg"
                });
            },
            cssSelectorAncestor: '#music-5'
        });

        $("#music6").jPlayer({
            ready: function () {
                $(this).jPlayer("setMedia", {
                    mp3:"http://www.jplayer.org/audio/mp3/TSP-01-Cro_magnon_man.mp3",
                    oga:"http://www.jplayer.org/audio/ogg/TSP-01-Cro_magnon_man.ogg",
                });
            },
            cssSelectorAncestor: '#music-6'
        });
    });//]]> 
  