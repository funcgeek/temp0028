<html>

<head>


  <link rel="stylesheet" href="db/canvas/css/signature-pad.css">

  <script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-39365077-1']);
    _gaq.push(['_trackPageview']);

    (function () {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
  </script>
</head>

<body>

  <div id="signature-pad" class="signature-pad">
    <div id="canvas-wrapper" class="signature-pad--body">
      <canvas></canvas>
    </div>
    <div class="signature-pad--footer">
      <div class="description">Sign above</div>

      <div class="signature-pad--actions">
        <div class="column">
          <button type="button" class="button clear" data-action="clear">Clear</button>
          <button type="button" class="button" data-action="undo" title="Ctrl-Z">Undo</button>
          <button type="button" class="button" data-action="redo" title="Ctrl-Y">Redo</button>
          <br/>
          <button type="button" class="button" data-action="change-color">Change color</button>
          <button type="button" class="button" data-action="change-width">Change width</button>
          <button type="button" class="button" data-action="change-background-color">Change background color</button>

        </div>
        <div class="column">
          <button type="button" class="button save" data-action="save-png">Save as PNG</button>
          <button type="button" class="button save" data-action="save-jpg">Save as JPG</button>
          <button type="button" class="button save" data-action="save-svg">Save as SVG</button>
          <button type="button" class="button save" data-action="save-svg-with-background">Save as SVG with
            background</button>
        </div>
      </div>

    </div>
  </div>

  <script src="db/canvas/js/signature_pad.umd.min.js"></script>
  <script src="db/canvas/js/app.js"></script>
</body>

</html>
