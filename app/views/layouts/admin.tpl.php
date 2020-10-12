<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" href="/skills/public/css/admin.css">
	<script type="text/javascript" src="/skills/public/js/jquery.js"></script>
</head>
<body>
	<div class="admin">
		<header class="admin_header">
			<a href="/skills/admin" class="logo">
				<!-- <h1>Skills</h1> -->
				<img src="/skills/public/img/logo.png" alt="logo">
			</a>
			<div class="toolbar">
				<p class="toolbar_profile"><span>Hello, </span><?php echo($_SESSION['admin']['login']); ?></p>
				<a href="/skills/admin/logout" class="logout">
					<img src="/skills/public/img/logout.png">
				</a>
			</div>
		</header>
		<nav class="admin_nav">
			<span class="menu_title">Operators</span>
			<ul class="menu">
				<li class="menu_item"><a href="/skills/admin/operators" class="menu_link">Список операторов</a></li>
				<li class="menu_item"><a href="/skills/admin/add_operator" class="menu_link">Добавить оператора</a></li>
			</ul>
			<span class="menu_title">Верификация Skills</span>
			<ul class="menu">
				<li class="menu_item"><a href="/skills/admin/verification_skills" class="menu_link">Верификация Skills</a></li>
				<li class="menu_item"><a href="/skills/admin/add_skill_to_operator" class="menu_link">Добавить скилл оператору</a></li>
			</ul>
			<span class="menu_title">Skills</span>
			<ul class="menu">
				<li class="menu_item"><a href="/skills/admin/skills" class="menu_link">Skills list</a></li>
				<li class="menu_item"><a href="/skills/admin/add_skill" class="menu_link">Add skill</a></li>
			</ul>
			<span class="menu_title">Verification method</span>
			<ul class="menu">
				<li class="menu_item"><a href="/skills/admin/verification_methods" class="menu_link">Verification method list</a></li>
				<li class="menu_item"><a href="/skills/admin/add_verification_method" class="menu_link">Add verification method</a></li>
			</ul>
			<span class="menu_title">Administrators</span>
			<ul class="menu">
				<li class="menu_item"><a href="/skills/admin/admin_management" class="menu_link">Admin list</a></li>
				<li class="menu_item"><a href="/skills/admin/add_admin" class="menu_link">Добавить администратора</a></li>
			</ul>
		</nav>
		<main class="admin_main">
			<?php echo $content; ?>
		</main>
		<footer class="admin_footer">
			<span>&copy; 2019 Froncast</span>
		</footer>
	</div>
	
	<script type="text/javascript" src="/skills/public/js/form.js"></script>
	<script type="text/javascript" src="/skills/public/js/basic.js"></script>
	<!-- <div class="modalDialog">
		<div id="modalClose">&#215</div>
		<div id="modalContentWrap">
			<div id="modalContent"></div>
		</div>
	</div> -->
</body>
</html>