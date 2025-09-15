<!DOCTYPE html>
<html>
 <link href="db/canvas/draw.css" rel="stylesheet">
<body>
	<section id="content">
	<canvas id="canvas" width="100%" height="auto">canvas</canvas>
		<ul id="tool">
			<li>
				<ul id="image">
					<li id="saveimg">
						<form action="db/canvas/down.php" id="myform" method="post">
							<input type="hidden" id="imgsave" name="dataImg" value="">
							<button>Save</button>
						</form>
					</li>
					<li id="clearimg">
						<button>Clear</button>
					</li>
				</ul>
			</li>
			<li>
				<h3>Tools</h3><hr>
				<ul id="tools">
					<li id="means_brush"><img src="db/canvas/imgs/Brush.png" alt="画笔" title="画笔"></li>
					<li id="means_eraser"><img src="db/canvas/imgs/Eraser.png" alt="" title="橡皮"></li>
					<li id="means_paint"><img src="db/canvas/imgs/Paint.png" alt="" title="喷漆"></li>
					<li id="means_straw"><img src="db/canvas/imgs/Straw.png" alt="" title="吸管"></li>
					<li id="means_text"><img src="db/canvas/imgs/text.png" alt="" title="文字"></li>
					<li id="means_magnifier"><img src="db/canvas/imgs/Magnifier.png" alt="" title="放大镜"></li>
				</ul>
			</li>
			<li>
				<h3>Shape</h3>
				<ul id="shape">
					<li id="means_line"><img src="db/canvas/imgs/line.png" /></li>
					<li id="means_arc"><img src="db/canvas/imgs/arc.png" /></li>
					<li id="means_rect"><img src="db/canvas/imgs/rect.png" /></li>
					<li id="means_poly"><img src="db/canvas/imgs/poly.png" /></li>
					<li id="means_arcfill"><img src="db/canvas/imgs/arcfill.png" /></li>
					<li id="means_rectfill"><img src="db/canvas/imgs/rectfill.png" /></li>
				</ul>
			</li>
			<li>
				<h3>Size</h3>
				<ul id="size">
					<li id="width_1"><img src="db/canvas/imgs/line1px.png" /></li>
					<li id="width_3"><img src="db/canvas/imgs/line3px.png" /></li>
					<li id="width_5"><img src="db/canvas/imgs/line5px.png" /></li>
					<li id="width_7"><img src="db/canvas/imgs/line7px.png" /></li>
				</ul>
			</li>
			<li>
				<h3>Color</h3>
				<ul id="color">
					<li id="red"></li>
					<li id="green"></li>
					<li id="blue"></li>
					<li id="yellow"></li>
					<li id="white"></li>
					<li id="black"></li>
					<li id="pink"></li>
					<li id="purple"></li>
					<li id="cyan"></li>
					<li id="orange"></li>
				</ul>
			</li>
		</ul>
		
	</section>
</body>

</html>