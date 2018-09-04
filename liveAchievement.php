<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="data/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"> 
	<title>Live Achievements</title>
	<style type="text/css">
		body {
			display:flex;
			align-items: center;
			justify-content: center;
			background-color: rgb(10,10,10);
		}
		.small {
			height:550px;
			width:300px;
			background-color:#202225;
			box-shadow: 0px 0px 5px;
		}
		.windowsBar {
			color:white;
			display:flex;
			align-items: center;
			justify-content: right;
			padding:1px;
		}
		.windowsBar i {
			padding:5px;
			cursor:pointer;
		}
		.windowsBar i:hover {
			color:lightgrey;
		}
		.titleBar {
			width:100%;
			padding:10px 0px 10px 0px;
			height:40px;
			background-color:#36393e;
			display:flex;
			align-items: center;
			justify-content: center;
		}
		.achBody {
			color:white;
			height:100%;
		}
		.achTitle {
			display:flex;
			align-items: center;
			justify-content: center;
			padding:5px;
		}
		.achBody ul {
			list-style: none;
			height:390px;
			overflow-y:scroll;
		}
		.achievement {
			width:100%;
			background-color:#36393e;
			padding:10px 0px 10px 0px;
			margin:5px 0px 5px 0px;
			text-align: center;
		}
		.achievement-title {
			font-size:20pt;
		}
		.achievement-description {
			font-style: italic;
		}
		.achievement > div {
			padding:2px;
		}
	</style>
</head>
<body>
	<div class="small">
		<div class="windowsBar">
			<i class="fas fa-window-minimize"></i><i class="fas fa-window-restore"></i><i class="fas fa-window-close"></i>
		</div>
		<div class="titleBar">
			<img src="data/AELogo2Light.png" height="40px">
		</div>
		<div class="achBody">
			<div class="achTitle">
				<img src="data/eu4.png" height="60px">
			</div>
			<ul>
				<li>
					<div class="achievement">
						<div class="achievement-title">
							<i class="fas fa-circle bronze" ></i> War with France
						</div>
						<div class="achievement-description">
							Declare War on France
						</div>
						<div class="achievement-progress">
							<i class="fas fa-check-circle"></i> Not at war with France
						</div>
					</div>
				</li>
				<li>
					<div class="achievement">
						<div class="achievement-title">
							<i class="fas fa-circle silver"></i> Mighty Army
						</div>
						<div class="achievement-description">
							Have an Army with a size of 100K
						</div>
						<div class="achievement-progress">
							<div class="pBar" style="width:calc(100% - 10px); height:20px; border-radius: 10px">
								<div class="pProgress" style="width:60%; height:10px; border-radius: 10px;">60%</div>
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="achievement">
						<div class="achievement-title">
							<i class="fas fa-circle diamond"></i> Three Mountains
						</div>
						<div class="achievement-description">
							Conquer every province as Ryukyu
						</div>
						<div class="achievement-progress">
							<i class="fas fa-times-circle"></i> Not Ryukyu
						</div>
					</div>
				</li>
				<li>
					<div class="achievement">
						<div class="achievement-title">
							<i class="fas fa-circle gold"></i> Mare Nostrum
						</div>
						<div class="achievement-description">
							Reunite the Roman Empire
						</div>
						<div class="achievement-progress">
							<div class="pBar" style="width:calc(100% - 10px); height:20px; border-radius: 10px">
								<div class="pProgress" style="width:10%; height:10px; border-radius: 10px;">10%</div>
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="achievement">
						<div class="achievement-title">
							<i class="fas fa-circle bronze"></i> A New World
						</div>
						<div class="achievement-description">
							Discover the Americas before 1500
						</div>
						<div class="achievement-progress">
							<i class="fas fa-check-circle"></i> Year is before 1500
						</div>
					</div>
				</li>
				<li>
					<div class="achievement">
						<div class="achievement-title">
							<i class="fas fa-circle bronze"></i> What Winter?
						</div>
						<div class="achievement-description">
							Capture Moscow during winter
						</div>
						<div class="achievement-progress">
							<i class="fas fa-check-circle"></i> Is Winter <br>
							<i class="fas fa-times-circle"></i> Occupies Moscow
						</div>
					</div>
				</li>
			</ul>
		</div>
	</div>
</body>
</html>