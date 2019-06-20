<head>
	<title>Ninja Pizza</title>
  <script src="https://kit.fontawesome.com/28f1a20f77.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body class="grey lighten-4">
	<nav class="nav-wrapper white z-depth-1">
		<div class="container">
			<i class="fas logo-pic fa-pizza-slice"></i>
			<a href="#" class="sidenav-trigger" data-target="slide-out">
				<i class="burger material-icons">menu</i>
			</a>
			<a href="index.php" class="brand-logo brand-text">
				Ninja Pizza 			
			</a>
			<ul class="right hide-on-med-and-down" id="nav-mobile">
				<li><a href="index.php" class="link z-depth-0">Pizza List</a></li>
				<li><a href="add.php" class="btn z-depth-1">Add a Pizza</a></li>
			</ul>
		</div>
	</nav>
	<ul class="sidenav" id="slide-out">
		<li><a href="index.php" class="wave-effect">Pizza List</a></li>
		<li><div class="divider"></div></li>
		<li><a href="add.php" class="wave-effect">Add a Pizza</a></li>
		<li><div class="divider"></div></li>
	</ul>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script type="text/javascript">
	 $(document).ready(function(){
    $('.sidenav').sidenav();
  });
</script>

	