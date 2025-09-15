<!doctype html>
<html>
  <head>
    <link href="db/canvas/_assets/literallycanvas.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no" />

    <style type="text/css">
      .fs-container {
        width: 320px;
        margin: auto;
      }

      .literally {
        width: 100%;
        height: 100%;
        position: relative;
      }
    </style>
  </head>

  <body>
    <div class="fs-container">
      <div id="lc"></div>
    </div>
<div class="literally export"></div>

<script>
  $(document).ready(function() {
    var lc = LC.init(document.getElementsByClassName('literally export')[0]);
    $('.controls.export [data-action=export-as-png]').click(function(e) {
      e.preventDefault();
      window.open(lc.getImage().toDataURL());
    });
  });
</script>
    <!-- you really ought to include react-dom, but for react 0.14 you don't strictly have to. -->
    <script src="db/canvas/js_libs/jquery-1.8.2.js"></script>
    <script src="db/canvas/_js_libs/literallycanvas.js"></script>

    <script type="text/javascript">
      var lc = LC.init(document.getElementById("lc"), {
        imageURLPrefix: 'db/canvas_assets/lc-images',
        toolbarPosition: 'bottom',
        defaultStrokeWidth: 2,
        strokeWidths: [1, 2, 3, 5, 30]
      });
    </script>
  </body>
</html>
