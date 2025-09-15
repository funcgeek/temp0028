<!DOCTYPE html>
<html>
	<link href="db/canvas/draw.css" rel="stylesheet">
<body>
	<section id="content">
	<canvas id="canvas" >canvas</canvas>
		<ul id="tool">
			<li>
				<h3>图像</h3><hr>
				<ul id="image">
					<li id="saveimg">
						<form action="down.php" id="myform" method="post">
							<input type="hidden" id="imgsave" name="dataImg" value="">
							<button>保存图片</button>
						</form>
					</li>
					<li id="clearimg">
						<button>清空画板</button>
					</li>
				</ul>
			</li>
			<li>
				<h3>工具</h3><hr>
				<ul id="tools">
					<li id="means_brush"><img src="db/canvas/Brush.png" alt="画笔" title="画笔"></li>
					<li id="means_eraser"><img src="db/canvas/Eraser.png" alt="" title="橡皮"></li>
					<li id="means_paint"><img src="db/canvas/Paint.png" alt="" title="喷漆"></li>
					<li id="means_straw"><img src="db/canvas/Straw.png" alt="" title="吸管"></li>
					<li id="means_text"><img src="db/canvas/text.png" alt="" title="文字"></li>
					<li id="means_magnifier"><img src="db/canvas/Magnifier.png" alt="" title="放大镜"></li>
				</ul>
			</li>
			<li>
				<h3>形状</h3>
				<ul id="shape">
					<li id="means_line"><img src="db/canvas/line.png" /></li>
					<li id="means_arc"><img src="db/canvas/arc.png" /></li>
					<li id="means_rect"><img src="db/canvas/rect.png" /></li>
					<li id="means_poly"><img src="db/canvas/poly.png" /></li>
					<li id="means_arcfill"><img src="db/canvas/arcfill.png" /></li>
					<li id="means_rectfill"><img src="db/canvas/rectfill.png" /></li>
				</ul>
			</li>
			<li>
				<h3>线宽</h3>
				<ul id="size">
					<li id="width_1"><img src="db/canvas/line1px.png" /></li>
					<li id="width_3"><img src="db/canvas/line3px.png" /></li>
					<li id="width_5"><img src="db/canvas/line5px.png" /></li>
					<li id="width_7"><img src="db/canvas/line7px.png" /></li>
				</ul>
			</li>
			<li>
				<h3>颜色</h3>
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
<script src="db/canvas/canvas.js"></script>

</html>