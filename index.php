<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="data/teamae.png">
	<link rel="stylesheet" type="text/css" href="data/style.css">
	<link rel="stylesheet" type="text/css" href="fonts/css/fontawesome-all.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<title>Achievement Engine</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>	
		$(document).ready(function() {
			function sticky_relocate() {
				var window_top = $(window).scrollTop();
				var div_top = $('#nav').offset().top;
				if(window_top > div_top) {
					$('#stickyNav').removeClass('hidden');
				} else {
					$('#stickyNav').addClass('hidden');
				}
			}

			$(window).scroll(sticky_relocate);
			sticky_relocate();

			$.fn.scrollView = function () {
			    return this.each(function () {
			        $('html, body').animate({
			            scrollTop: $(this).offset().top - 50
			        }, 1000);
			    });
			}

			$('#floatlogo').click(function() {
				$('#top').scrollView();
			});
			$('#staticlogo').click(function() {
				$('#top').scrollView();
			});
			$('#aimsbtn-float').click(function() {
				$('#aims').scrollView();
			});
			$('#aimsbtn-static').click(function() {
				$('#aims').scrollView();
			});
			$('#systembtn-float').click(function() {
				$('#system').scrollView();
			});
			$('#systembtn-static').click(function() {
				$('#system').scrollView();
			});
			$('#membersbtn-float').click(function() {
				$('#members').scrollView();
			});
			$('#membersbtn-static').click(function() {
				$('#members').scrollView();
			});
			$('#contactbtn-float').click(function() {
				$('#contact').scrollView();
			});
			$('#contactbtn-static').click(function() {
				$('#contact').scrollView();
			});


			$('#cloudBtn').click(function() {
				$('#cloud').removeClass('gone');
				$('#desktop').addClass('gone');
				$('#game').addClass('gone');
				$('#cloudBtn').addClass('active');
				$('#desktopBtn').removeClass('active');
				$('#gameBtn').removeClass('active');
			});
			$('#desktopBtn').click(function() {
				$('#cloud').addClass('gone');
				$('#desktop').removeClass('gone');
				$('#game').addClass('gone');
				$('#cloudBtn').removeClass('active');
				$('#desktopBtn').addClass('active');
				$('#gameBtn').removeClass('active');
			});
			$('#gameBtn').click(function() {
				$('#cloud').addClass('gone');
				$('#desktop').addClass('gone');
				$('#game').removeClass('gone');
				$('#cloudBtn').removeClass('active');
				$('#desktopBtn').removeClass('active');
				$('#gameBtn').addClass('active');
			});
		});
	</script>
	<style type="text/css">
		.mainImg > img {
			width:100%;
			height:100vh;
		}
		.sticky {
			position:fixed;
			top:0;
			width:100%;
			transition:visibility 0.2s;
		}
		.nav ul {
			list-style: none;
			text-align: center;
			padding:10px;
			background-color:;
		}
		.nav ul li {
			width:150px;
			display: inline-block;
			background-color: #7e4f9b;
			padding:10px 15px 10px 15px;
			margin:0px 10px 0px 10px;
			font-size: 20pt;
			box-shadow: 0px 0px 10px #7e4f9b;
			border-radius:25px;
			cursor:pointer;
			transition: opacity 0.2s;

		}
		.nav ul li:hover {
			opacity:0.5;
		}
		.topimg {
			background-image: url("data/backgroundedit.jpg");
			background-size:cover;
			background-repeat: no-repeat;
			background-position: center center;
			width:100%;
			height:calc(100vh - 65px);
			display:flex;
			align-items: center;
			justify-content: center;
			flex-direction: column;
			text-shadow: 0px 0px 10px white;
		}
		.topimg img {
			height:200px;
			width:600px;
		}
		.topText {
			font-size: 28pt;
			margin-top:20px;
			color:white;
			font-weight: 200;
			font-style: italic;
		}

		.theIssue {
			display:flex;
			align-items: center;
			justify-content: center;
			flex-wrap: wrap;
			padding:100px 300px 100px 300px;
		}
		.issue {
			width:350px;
			height:200px;
			margin:5px;
			text-align: center;
			padding:20px;
			color:white;
			font-style: italic;
		}
		.issueTitle {
			font-size: 18pt;
			padding:5px;
			font-weight: 600;
			font-style: normal;
		}
		.issueBody {
			line-height: 20px;
		}
		.iTitle {
			width:100%;
			text-align: center;
			font-size:32pt;
			margin-top:-50px;
			margin-bottom:30px;
			color:white;
			font-weight:600;
		}
		blockquote {
			padding:50px 300px 50px 300px;
			font-size:25pt;
			display: flex;
			align-items: center;
			justify-content: center;
			color:white;
		}
		.quote {
			word-wrap: normal;
		}
		.quote-attribution {
			font-size:20pt;
			margin-left:25px;
			margin-top:20px;
			font-style: italic;
		}
		.hidden {
			visibility: hidden;
		}
		.fa-glow {
			text-shadow: 0px 0px 10px #ffffff;
		}
		.system {
			padding:100px 300px 100px 300px;
			color:white;
			display:flex;
			align-items: center;
			justify-content: center;
			flex-wrap: wrap;
		}
		.system-title {
			width:100%;
			text-align: center;
			font-size:32px;
			font-weight: 600;
			padding-bottom:25px;
		}
		.system-component {
			background-color: #58aa6a;
			padding:25px;
			margin:10px;
			display:flex;
			align-items: center;
			justify-content: center;
			flex-direction: column;
			width:150px;
			border-radius:100px;
			cursor:pointer;
			transition:opacity 0.2s;
			text-shadow: 0px 0px 10px white;
		}
		.system-component div {
			margin:5px;
		}
		.system-component:hover {
			opacity:0.5;
		}
		.system-information div {
			font-size:14pt;
		}
		.system-information h1 {
			font-size:20pt;
			margin-bottom:10px;
		}
		.system-information {
			width:100%;
			margin:25px 100px 25px 100px;
			padding:25px;
			border-radius:25px;
			height:100px;
		}
		.gone {
			display:none;
		}
		.active {
			color:black;
			text-shadow: 0px 0px 10px black;
		}
		.achClasses {
			padding:50px 300px 50px 300px;
			font-size:25pt;
			display: flex;
			align-items: top;
			justify-content: center;
			flex-wrap: wrap;
			color:white;
		}
		.achClasses h1 {
			width:100%;
			text-align: center;
			padding-bottom:20px;
		}
		.achClass {
			width:200px;
			text-align: center;
			padding:25px;
		}
		.achClass h1 {
			width:100%;
			padding-bottom:10px;
		}
		.achClass-desc {
			font-size:12pt;
			text-align:center;
			font-style: italic;
		}
		.members {
			padding:100px 300px 50px 300px;
			display:flex;
			align-items: center;
			justify-content: center;
			flex-wrap: wrap;
			color:white;
		}
		.mTitle {
			width:100%;
			text-align: center;
			margin-top:-50px;
			margin-bottom:70px;
			font-size:32px;
			font-weight: 600;
		}
		.member {
			padding:10px;
			width:300px;
			margin:10px 10px 50px 10px;
			background-color:#2f2f33;
			text-align: center;
			height:100%;
		}
		.member img {
			margin-top:-50px;
			object-fit: cover;
			height:100px;
			width:100px;
		}
		.member div {
			padding:5px;
		}
		.member-name {
			font-size:20pt;
		}
		.member-role {
			font-style: italic;
			font-size:14pt;
		}
		.member-bio {
			text-align: justify;
			font-size:10pt;
			height:120px;
		}
		.contact {
			padding:50px 300px 50px 300px;
		}
		.developer {
			font-size:30pt;
			display:flex;
			align-items: center;
			justify-content: center;
		}
		.developer-text {
			padding:0px 20px 0px 20px;
			color:#58aa6a;
			text-shadow: 0px 0px 10px #58aa6a;
		}
		.clip {
			clip-path: circle(50% at 50% 50%);
		}
		.round {
			border-radius: 50%;
		}
	</style>
</head>
<body>
	<div id="stickyNav" class="nav dgrey hidden sticky">
		<ul>
			<li id="aimsbtn-float">
				Aims
			</li>
			<li id="systembtn-float">
				The System
			</li>
			<li id="floatlogo">
				<img src="data/AELogo2Light.png" height="25px">
			</li>
			<li id="membersbtn-float">
				Members
			</li>
			<li id="contactbtn-float">
				Contact
			</li>
		</ul>
	</div>
	<div class="mainImg" id="top">
		<div class="topimg">
			<img src="data/AELogo2Light.png">
			<div class="topText">
				Reinventing Game Achievements
			</div>
			<a href="/website/login.php" class="button" style="color:#58aa6a;text-shadow:none;border-radius:15px;font-size:20px">Beta Site</a>
		</div>
		<div id="nav" class="nav dgrey">
			<ul>
				<li id="aimsbtn-static">
					Aims
				</li>
				<li id="systembtn-static">
					The System
				</li>
				<li id="staticlogo">
					<img src="data/AELogo2Light.png" height="25px" width="75px">
				</li>
				<li id="membersbtn-static">
					Members
				</li>
				<li id="contactbtn-static">
					Contact
				</li>
			</ul>
		</div>
	</div>
	<div class="theIssue" id="aims">
		<div class="iTitle">
			Aims
		</div>
		<div class="issue">
			<div>
				<i class="fas fa-globe fa-5x fa-glow"></i>
			</div>
			<div class="issueTitle">
				Unified Achievement System
			</div>
			<div class="issueBody">
				Keeping a gamer's achievements in one place for easy tracking and comparison for tracking and comparing
			</div>
		</div>
		<div class="issue">
			<div>
				<i class="fas fa-trophy fa-5x fa-glow"></i>
			</div>
			<div class="issueTitle">
				Rewarding Gamers
			</div>
			<div class="issueBody">
				Through their achievement progress gamers provided with rewards to show off to their friends providing a sense of pride and accomplishment
			</div>
		</div>
		<div class="issue">
			<div>
				<i class="fas fa-user-friends fa-5x fa-glow"></i>
			</div>
			<div class="issueTitle">
				Sharing Progress
			</div>
			<div class="issueBody">
				Gamers synchronise all their compatible games achievements through the system so they can easily share it with friends
			</div>
		</div>
		<div class="issue">
			<div>
				<i class="fas fa-gamepad fa-5x fa-glow"></i>
			</div>
			<div class="issueTitle">
				Playing Favourite Games
			</div>
			<div class="issueBody">
				All this happens whilst gamers are still playing their favourite games whether they are achievement hunters or not
			</div>
		</div>
		<div class="issue">
			<div>
				<i class="fas fa-code fa-5x fa-glow"></i>
			</div>
			<div class="issueTitle">
				Empowering Developers
			</div>
			<div class="issueBody">
				Through providing simple and easy to use plugins and instructions Developers don't have to waste any more time developing their own achievement systems
			</div>
		</div>
	</div>
	<blockquote class="dgrey">
		<div class="quote">
			<i class="fas fa-quote-left"></i>
			The intent is to provide players with a sense of pride and accomplishment for unlocking different heroes
			<i class="fas fa-quote-right"></i>
			<div class="quote-attribution">
				- Electronic Arts
			</div>
		</div>
	</blockquote>
	<div class="system" id="system">
		<div class="system-title">
			The System
		</div>
		<div id="cloudBtn" class="system-component glow-green active">
			<i class="fas fa-cloud fa-2x"></i>
			<div>
				The Cloud
			</div>
		</div>
		<i class="fas fa-arrow-left fa-5x greenText"></i>
		<div id="desktopBtn" class="system-component glow-green">
			<i class="fas fa-desktop fa-2x"></i>
			<div>
				Desktop App
			</div>
		</div>
		<i class="fas fa-arrow-left fa-5x greenText"></i>
		<div id="gameBtn" class="system-component glow-green">
			<i class="fas fa-gamepad fa-2x"></i>
			<div>
				Game
			</div>
		</div>
		<div class="system-information dgrey">
			<div id="cloud" class="">
				<h1>The Cloud</h1>
				All achievement data is stored in the cloud on our server where it can be easily accessed from a browser or sent back to the desktop client to ensure real-time achievement tracking.
			</div>
			<div id="desktop" class="gone">
				<h1>Desktop App</h1>
				The Desktop app recieves messages from the game about what achievements are being completed or are making progress. From here the user can easily see in real-time what progress they are making and whether they meet certain achievement prerequisites.
			</div>
			<div id="game" class="gone">
				<h1>Game</h1>
				A game integrated with our system will simply implement a plugin that will allow the developer to quite simply make callbacks to our plugin to inform it about achievement status. The plugin then sends that information to the desktop client.
			</div>
		</div>
	</div>
	<div class="achClasses dgrey">
		<h1>
			Achievement Classes
		</h1>
		<div class="achClass">
			<h1>
				<i class="fas fa-circle bronze"></i> Bronze
			</h1>
			<div class="achClass-desc">
				No extra effort required
			</div>
		</div>
		<div class="achClass">
			<h1>
				<i class="fas fa-circle silver"></i> Silver
			</h1>
			<div class="achClass-desc">
				May take Extra Effort
			</div>
		</div>
		<div class="achClass">
			<h1>
				<i class="fas fa-circle gold"></i> Gold
			</h1>
			<div class="achClass-desc">
				Requires Skill and Practise
			</div>
		</div>
		<div class="achClass">
			<h1>
				<i class="fas fa-circle diamond"></i> Diamond
			</h1>
			<div class="achClass-desc">
				Only for the most daring
			</div>
		</div>
	</div>
	<div class="members" id="members">
		<div class="mTitle">
			Team Members
		</div>
		<div class="member">
			<img src="https://scontent.xx.fbcdn.net/v/t1.15752-0/p480x480/34070964_10204178221651120_3692121584639672320_n.jpg?_nc_cat=0&_nc_ad=z-m&_nc_cid=0&oh=ec89f11bd9063dd7af02d956b73a32c6&oe=5BB60BE3" class="round glow-white">
			<div class="member-name">
				Jake Juretic
			</div>
			<div class="member-role">
				Team Leader
			</div>
			<div class="member-bio">
				Computer enthusiast studying Computer Science at the University of Wollongong, majoring in Cyber Security. With an interest in all things tech, I enjoy programming, pen testing, and gaming. Computing has been a career path I've always wanted, and it's everything I'd hoped. I have high hopes of becoming a white hat hacker in the future, and working within information security.
			</div>
		</div>
		<div class="member">
			<img src="https://scontent-syd2-1.xx.fbcdn.net/v/t1.0-9/13226689_1166365536721451_645010810966200052_n.jpg?_nc_cat=0&oh=5744e8415fceced08234fb4caf6f0659&oe=5C27FFAB" class="round glow-white">
			<div class="member-name">
				Cameron Burrows
			</div>
			<div class="member-role">
				Lead Programmer
			</div>
			<div class="member-bio">
				Hailing from the Sutherland Shire, I attended Kirrawee High School before graduating to study a Bachelor of Computer Science at Wollongong University. I have experience using HTML, CSS, Javascript, PHP, SQL, C++, Java, C# and Swift which will allow me to take on the role of Lead programmer and bring my experience and knowledge to the other group members to produce a final quality product.
			</div>
		</div>
		<div class="member">
			<img src="https://scontent-syd2-1.xx.fbcdn.net/v/t1.0-1/c0.0.160.160/p160x160/17796588_1410565089008661_1105075637683509917_n.jpg?_nc_cat=0&oh=684597b5a244e8de5692f4447209885a&oe=5BBDBF20" class="round glow-white">
			<div class="member-name">
				Benjamin Harrison
			</div>
			<div class="member-role">
				Programmer
			</div>
			<div class="member-bio">
				Currently studying a bachelor of computer science, with a major of game and multimedia development. I have a great interest in all things computers, gaming and have a goal of creating my own game using the skills and knowledge I've learnt from university and from self teaching.
			</div>
		</div>
		<div class="member">
			<img src="https://scontent-syd2-1.xx.fbcdn.net/v/t1.0-9/12688283_1227494160611385_5326501389769914976_n.jpg?_nc_cat=0&oh=f6c04546d5193db5195458cd2f92f7b9&oe=5BF1F3B3" class="round glow-white">
			<div class="member-name">
				Chris Lawson
			</div>
			<div class="member-role">
				Programmer
			</div>
			<div class="member-bio">
				I was born in Sydney and grew up in the suburb of Collaroy Plateau. I attended local public schools till the end of year 10 when my family and I moved to a rural property outside of Bega on the Far South Coast of NSW. It was there that I graduated from Bega High School after the completion of my HSC.  I am now living away from home, studying a Bachelor of Computer Science at the University of Wollongong.
			</div>
		</div>
		<div class="member">
			<img src="https://scontent-syd2-1.xx.fbcdn.net/v/t1.0-9/28279007_10213677971816327_4009046032532046626_n.jpg?_nc_cat=0&oh=3ca40f8e6ee3829dc18abc30ac392c64&oe=5C24D66F" class="round glow-white">
			<div class="member-name">
				Adam Stroud
			</div>
			<div class="member-role">
				Project Manager
			</div>
			<div class="member-bio">
				Born in Sydney, Australia, went to school at Holy Family Primary, followed by Menai High School. I graduated High School after completing my HSC and now im currently studying a Bachelors Degree in Information Technology, Majoring Network Design and Management at the Univeristy of Wollongong.
			</div>
		</div>
	</div>
	<div class="contact dgrey" id="contact" style="color:#d3d3d3">
		<div class="developer">
			<img src="data/teamae.png" height="50px" class="round glow-green">
			<div class="developer-text">
				Team AE
			</div>
		</div>
		Team AE is a Group of avid gamers who foldly remember the golden age of Game Achievements when you competed against your friends to see who could 100% a game, but as we grew older and transitioned to PC gaming we found a sincere lack of PC achievements support. While they may have existed on various platforms or baked into individual games, the lack of any uniformity meant PC gamers couldn't hunt achievements like they used to on their Xbox 360s and PS3s.<br>
		Our mission is to usher in a new era of PC gaming achievements and bring forth a new age, nay a Golden Age, of PC gaming achievements where friends can compete to get achievements in their favourite games, whether they play First-Person Shooters, Strategy games or even Point and Click adventure games. All shall be treated equal in the age of the Achievement Engine.
	</div>
</body>
</html>