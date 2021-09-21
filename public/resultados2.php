<?php
	require("grafos.php");
    $nodo1=$_POST['nodo1'];
    $nodo2=$_POST['nodo2'];
    $guardar=fopen('nodos.txt','a+');
    fwrite($guardar,$nodo1);
    fwrite($guardar,',');
	fwrite($guardar,$nodo2);
    fwrite($guardar,"\n");
    $nodo3=$_POST['nodo3'];
    $nodo4=$_POST['nodo4'];
    fwrite($guardar,$nodo3);
    fwrite($guardar,',');
	fwrite($guardar,$nodo4);
    fclose($guardar);
?>
<!DOCTYPE HTML>
<html lang="es">
	<head>

	<!--TRABAJO 1-->	

		<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Trabajo 1</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by freehtml5.co" />
	<meta name="author" content="freehtml5.co" />

	

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,700,800" rel="stylesheet">	 -->
	<link href="https://fonts.googleapis.com/css?family=Inconsolata:400,700" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- Flexslider  -->
	<link rel="stylesheet" href="css/flexslider.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	<script src="https://d3js.org/d3.v7.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="js/raphael-2.3.0/raphael.min.js"></script>
	<script type="text/javascript" src="js/GrafosD.js" >
		window.onload = function() {
	 
		 var g = new Graph();
	 
					 g.addEdge("ME", "QUIERO");
					 g.addEdge("QUIERO", "MORIR");
					
	 
					 /* layout the graph using the Spring layout implementation */
					 var layouter = new Graph.Layout.Spring(g);
					 layouter.layout();
		 
					 /* draw the graph using the RaphaelJS draw implementation */
					 var renderer = new Graph.Renderer.Raphael('canvas', g, 600, 400);
					 renderer.draw();
		 
					 redraw = function() {
						 layouter.layout();
						 renderer.draw();
					 };
		};
	   </script>
	</head>
	<body>

	<!--TRABAJO 1-->	
	
	<div class="fh5co-loader"></div>
	
	<div id="page">
	<nav class="fh5co-nav" role="navigation">
		<div class="top-menu">
			<div class="container">
				<div class="row">
					<div class="col-xs-2">
						<div id="fh5co-logo"><a href="">GFYLH Trabajos<span>.</span></a></div>
					</div>
					<div class="col-xs-10 text-right menu-1">
						<ul>
							<li><a href="../public/views/index.html">Inicio</a></li>
							<li class="has-dropdown">
								<a href="blog.html">Trabajo 1</a> 
								<ul class="dropdown">
									<li><a href="#">Trabajo</a></li>
									<li><a href="#">Listo</a></li>
								</ul>
							</li>
							<li class="has-dropdown">
								<a href="blog.html">Trabajo 2</a>
								<ul class="dropdown">
									<li><a href="#">Trabajo</a></li>
									<li><a href="#">en</a></li>
									<li><a href="#">desarrollo</a></li>
								</ul>
							</li>
							<li class="has-dropdown">
								<a href="blog.html">Trabajo 3</a>
								<ul class="dropdown">
									<li><a href="#">Trabajo</a></li>
									<li><a href="#">en</a></li>
									<li><a href="#">desarrollo</a></li>
								</ul>
							</li>
							<li class="has-dropdown">
								<a href="blog.html">Trabajo Integral</a>
								<ul class="dropdown">
									<li><a href="#">Trabajo</a></li>
									<li><a href="#">en</a></li>
									<li><a href="#">desarrollo</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
				
			</div>
		</div> 
	</nav>

	<div id="fh5co-about">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<h2>Trabajo 1</h2>
					<p>En la siguiente pagina se podra observar el desarrollo de la primera actividad a evaluar, la cual posee las siguientes exigencias:
						<ul caption = "justify">
							<li>Lograr ingresar un grafo a la aplicación</li>
							<li>Mostrar matriz de caminos e indicar si el grafo es o no conexo.</li>
							<li>Mostrar el camino más corto para dos nodos a elección del usuario, mostrando la duración
								y la ruta de dicho camino (nodos por los que pasa).</li>
							<li>Indicar si es hamiltoniano y/o euleriano, indicando el camino hamiltoniano y/o euleriano
								que lo define como tal.</li>
							<li>Indicar el flujo máximo para un nodo de origen/entrada y otro de destino/salida a elección
								del usuario.</li>
							<li>Obtener el árbol generador mínimo mediante prim o kruskal.</li>
						</ul>
					</p>
				</div>
			</div>
			<div class="row animate-box">	
				<div class="col-md-6 col-md-offset-3 text-center heading-section">
					<h3>Resultados</h3>
                    <p> 
						<ul caption = "justify">
							<li> Matriz camino: </li>
						</ul>
						<?php 
							$matriz_c= matriz_caminos();
							mostrar_matriz($matriz_c);
						?>
						<ul caption = "justify">
							<li>
							<?php 
								$conex=matriz_conexa();
								if($conex==true)
								{
									print_r('Su matriz es conexa.');
								}
								else
								{
									print_r('Su matriz no es conexa.');
								}
							?>
							</li>
							<li>Matriz valores:</li>
						</ul>
						<?php 
								$matriz_a=matriz_valoresA();
								mostrar_matriz($matriz_a);
						?>
						<ul caption = "justify">
							<li>
								<?php
									$eu=euleriano();
									if($eu == true)
									{
										print_r('Su grafo es euleriano.');
										print_r("\n");
										echo '<li/>';
										print_r('Su camino euleriano es: ');
										camino_euler();
										print_r('.');
									}
									else
									{
										print_r('Su grafo no es euleriana.');
									}
								?>
							</li>
							<li> 
									<?php
										hamiltoniano();
									?>
							</li>
							<li>
                                    <?php
                                        $cam=caminos();
                                        if($cam)
                                        {
                                            print_r('Su camino optimo es: ');
                                            print_r($cam[0]);
                                            print_r("\n");
                                            echo '<li/>';
                                            print_r('Su distancia total es: ');
                                            print_r($cam[1]);
                                        }
                                        else
                                            print_r('No existe camino');
                                    ?>
							</li>
							<li>
								<?php
									flujo_maximo();
								?>
							</li>
								
						</ul>
                        <a href="trabajo1.php"><input type="button" value="Ir a trabajo 1"></a>
                    </p>
				<div>
			</div>
		</div>
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><em class="icon-arrow-up22"></em></a>
	</div>
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Flexslider -->
	<script src="js/jquery.flexslider-min.js"></script>
	<!-- Main -->
	<script src="js/main.js"></script>

	</body>
</html>

