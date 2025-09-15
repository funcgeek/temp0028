<script>
var canvas = document.getElementById('signature');
var ctx = canvas.getContext("2d");
var drawing = false;
var prevX, prevY;
var currX, currY;
var signature = document.getElementsByName('signature')[0];

canvas.addEventListener("mousemove", draw);
canvas.addEventListener("touchmove", draw);
canvas.addEventListener("mouseup", stop);
canvas.addEventListener("touchend", stop);
canvas.addEventListener("mousedown", start);
canvas.addEventListener("touchstart", start);

function start(e) {
  drawing = true;
}

function stop() {
  drawing = false;
  prevX = prevY = null;
  signature.value = canvas.toDataURL();
}

function draw(e) {
  if (!drawing) {
    return;
  }
  // Test for touchmove event, this requires another property.
  var clientX = e.type === 'touchmove' ? e.touches[0].clientX : e.clientX;
  var clientY = e.type === 'touchmove' ? e.touches[0].clientY : e.clientY;
  currX = clientX - canvas.offsetLeft;
  currY = clientY - canvas.offsetTop;
          var rect = canvas.getBoundingClientRect();
        var xoff = rect.left;
        var yoff = rect.top;
  if (!prevX && !prevY) {
    prevX = currX;
    prevY = currY;
  }

  ctx.beginPath();
  ctx.moveTo(prevX, prevY);
  ctx.lineTo(currX, currY);
  ctx.strokeStyle = 'black';
  ctx.lineWidth = 2;
  ctx.stroke();
  ctx.closePath();

  prevX = currX;
  prevY = currY;
}

function onSubmit(e) {
  console.log({
    'name': document.getElementsByName('name')[0].value,
    'signature': signature.value,
  });
  return false;
}
</script>

<style>
canvas#signature {
  border: 2px solid black;
}

form>* {
  margin: 10px;
}
</style>

<form action="submit.php" onsubmit="return onSubmit(this)" method="post">
  <div>
    <input name="name" placeholder="Your name" required />
  </div>
  <div>
    <canvas id="signature" width="300" height="100"></canvas>
  </div>
  <div>
    <input type="hidden" name="signature" />
  </div>
  <button type="submit">Send</button>
  <form>