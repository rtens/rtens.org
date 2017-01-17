<?php

$blog = simplexml_load_file('http://blog.rtens.org/feeds/all.atom.xml');

$mailSent = false;
$isBot = false;
if (!empty($_POST['foo']) && strtolower($_POST['foo']) != 'no') {
    $isBot = true;
} else if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])) {
    mail('contact@rtens.org', '[rtens.org] New message', $_POST['message'], "From: {$_POST['name']} <{$_POST['email']}>");
    $mailSent = true;
}

?>
<!DOCTYPE HTML>
<!--
	Read Only by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Nikolas.M@rtens</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link rel="icon" type="image/png" href="images/zells.png">
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.scrollzer.min.js"></script>
		<script src="js/jquery.scrolly.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
	</head>
	<body>
		<div id="wrapper">

			<!-- Header -->
				<section id="header" class="skel-layers-fixed">
					<header>
						<span class="image avatar"><img src="images/avatar.jpg" alt="" /></span>
						<h1 id="logo"><a href="/">Nikolas Martens</a></h1>
            <ul class="icons">
                <li><a href="http://twitter.com/rtens_" target="_blank" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
                <li><a href="http://github.com/rtens" target="_blank" class="icon fa-github"><span class="label">Github</span></a></li>
                <li><a href="http://nikolasalokin.deviantart.com/" target="_blank" class="icon fa-deviantart"><span class="label">DeviantArt</span></a></li>
                <li><a href="mailto:contact@rtens.org" target="_blank" class="icon fa-envelope"><span class="label">Email</span></a></li>
            </ul>
					</header>
					<nav id="nav">
						<ul>
							<li><a href="#about">About</a></li>
							<li><a href="#blog">Blog</a></li>
							<li><a href="#projects">Projects</a></li>
							<li><a href="#contact">Contact</a></li>
						</ul>
					</nav>
					<footer>
					</footer>
				</section>

			<!-- Main -->
				<div id="main">

					<!-- One -->
						<section>
							<div class="container">
								<header class="major">
									<h2>Nikolas.M@rtens.org</h2>
									<p>
                                        <a href="#about:engineer">Software Engineer</a>
                                        |
                                        <a href="#about:coach">Coach</a>
                                        |
                                        <a href="#about:consultant">Consultant</a>
                                    </p>
								</header>
								<?php include __DIR__ . '/../content/introduction.html' ?>
							</div>
						</section>
						
					<!-- Two -->
						<section id="about">
							<div class="container">
                                <?php include __DIR__ . '/../content/about.html'; ?>
							</div>
						</section>

					<!-- Three -->
						<section id="blog">
							<div class="container">
								<h3>Latest Articles</h3>

                                <p>In my blog, I philosophize about software, testing and my approaches to mostly technical topics.</p>

                                <ul class="actions small">
                                    <li><a href="http://blog.rtens.org" target="_blank" class="button icon fa-angle-double-right">See all articles</a></li>
                                </ul>

                                <div class="features">
									<?php $i=0; foreach ($blog->entry as $entry) { $i++; if ($i > 3) break; ?>
									<article>
                                        <a href="<?php echo $entry->link['href'] ?>" target="_blank" class="image">
                                            <h4><?php echo $entry->title ?></h4>
                                            <h5><?php echo date('Y-m-d', strtotime($entry->updated) + 7200); ?></h5>
                                        </a>
										<div class="inner">
                                            <?php echo str_replace('<p>', '', explode('</p>', $entry->summary)[0]); ?>
                                            <a href="<?php echo $entry->link['href'] ?>" target="_blank"><strong>&raquo; read more</strong></a>
										</div>
									</article>
									<?php } ?>
								</div>
							</div>
						</section>

                        <section id="projects">
                            <div class="container">
                                <h3>Open Source Projects</h3>
                                <?php include __DIR__ . '/../content/projects.html'; ?>
                            </div>
                        </section>
						
					<!-- Four -->
						<section id="contact">
							<div class="container">
								<h3>Contact Me</h3>
                                <?php if ($isBot) { ?>
                                    <div class="alert alert-danger">Seems like you're a bot. <a href="/">Click here if you're human.</a></div>
                                <?php } else if ($mailSent) { ?>
                                    <div class="alert alert-success">Thank you for your message. I will get back to you as soon as possible.</div>
                                <?php } else { ?>
								<form method="post" action="index.php#contact">
									<div class="row uniform">
										<div class="6u 12u(3)"><input type="text" name="name" id="name" placeholder="Name" required="required" /></div>
										<div class="6u 12u(3)"><input type="email" name="email" id="email" placeholder="Email" required="required" /></div>
									</div>
									<div class="row uniform">
										<div class="12u"><textarea name="message" id="message" placeholder="Message" rows="6" required="required"></textarea></div>
									</div>
									<div class="row uniform">
										<div class="12u">Are you a bot?<input type="text" name="foo"/></div>
									</div>
									<div class="row uniform">
										<div class="12u">
											<ul class="actions">
												<li><input type="submit" class="special" value="Send Message" /></li>
												<li><input type="reset" value="Reset Form" /></li>
											</ul>
										</div>
									</div>
								</form>
                                <?php } ?>
							</div>
						</section>
				
					<!-- Five -->
                    <!--
						<section id="five">
							<div class="container">
								<h3>Elements</h3>

								<section>
									<h4>Text</h4>
									<p>This is <b>bold</b> and this is <strong>strong</strong>. This is <i>italic</i> and this is <em>emphasized</em>.
									This is <sup>superscript</sup> text and this is <sub>subscript</sub> text.
									This is <u>underlined</u> and this is code: <code>for (;;) { ... }</code>. Finally, <a href="#">this is a link</a>.</p>
									<hr />
									<header>
										<h4>Heading with a Subtitle</h4>
										<p>Lorem ipsum dolor sit amet nullam id egestas urna aliquam</p>
									</header>
									<p>Nunc lacinia ante nunc ac lobortis. Interdum adipiscing gravida odio porttitor sem non mi integer non faucibus ornare mi ut ante amet placerat aliquet. Volutpat eu sed ante lacinia sapien lorem accumsan varius montes viverra nibh in adipiscing blandit tempus accumsan.</p>
									<header>
										<h5>Heading with a Subtitle</h5>
										<p>Lorem ipsum dolor sit amet nullam id egestas urna aliquam</p>
									</header>
									<p>Nunc lacinia ante nunc ac lobortis. Interdum adipiscing gravida odio porttitor sem non mi integer non faucibus ornare mi ut ante amet placerat aliquet. Volutpat eu sed ante lacinia sapien lorem accumsan varius montes viverra nibh in adipiscing blandit tempus accumsan.</p>
									<hr />
									<h2>Heading Level 2</h2>
									<h3>Heading Level 3</h3>
									<h4>Heading Level 4</h4>
									<h5>Heading Level 5</h5>
									<h6>Heading Level 6</h6>
									<hr />
									<h5>Blockquote</h5>
									<blockquote>Fringilla nisl. Donec accumsan interdum nisi, quis tincidunt felis sagittis eget tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan faucibus. Vestibulum ante ipsum primis in faucibus lorem ipsum dolor sit amet nullam adipiscing eu felis.</blockquote>
									<h5>Preformatted</h5>
									<pre><code>i = 0;

while (!deck.isInOrder()) {
    print 'Iteration ' + i;
    deck.shuffle();
    i++;
}

print 'It took ' + i + ' iterations to sort the deck.';</code></pre>
								</section>

								<section>
									<h4>Lists</h4>
									<div class="row">
										<div class="6u 12u(3)">
											<h5>Unordered</h5>
											<ul>
												<li>Dolor pulvinar etiam magna etiam.</li>
												<li>Sagittis adipiscing lorem eleifend.</li>
												<li>Felis enim feugiat dolore viverra.</li>
											</ul>
											<h5>Alternate</h5>
											<ul class="alt">
												<li>Dolor pulvinar etiam magna etiam.</li>
												<li>Sagittis adipiscing lorem eleifend.</li>
												<li>Felis enim feugiat dolore viverra.</li>
											</ul>
										</div>
										<div class="6u 12u(3)">
											<h5>Ordered</h5>
											<ol>
												<li>Dolor pulvinar etiam magna etiam.</li>
												<li>Etiam vel felis at lorem sed viverra.</li>
												<li>Felis enim feugiat dolore viverra.</li>
												<li>Dolor pulvinar etiam magna etiam.</li>
												<li>Etiam vel felis at lorem sed viverra.</li>
												<li>Felis enim feugiat dolore viverra.</li>
											</ol>
											<h5>Icons</h5>
											<ul class="icons">
												<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
												<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
												<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
												<li><a href="#" class="icon fa-github"><span class="label">Github</span></a></li>
												<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
												<li><a href="#" class="icon fa-tumblr"><span class="label">Tumblr</span></a></li>
											</ul>
										</div>
									</div>
									<h5>Actions</h5>
									<ul class="actions">
										<li><a href="#" class="button special">Default</a></li>
										<li><a href="#" class="button">Default</a></li>
										<li><a href="#" class="button alt">Default</a></li>
									</ul>
									<ul class="actions small">
										<li><a href="#" class="button special small">Small</a></li>
										<li><a href="#" class="button small">Small</a></li>
										<li><a href="#" class="button alt small">Small</a></li>
									</ul>
									<div class="row">
										<div class="3u 6u(2) 12u$(3)">
											<ul class="actions vertical">
												<li><a href="#" class="button special">Default</a></li>
												<li><a href="#" class="button">Default</a></li>
												<li><a href="#" class="button alt">Default</a></li>
											</ul>
										</div>
										<div class="3u 6u$(2) 12u$(3)">
											<ul class="actions vertical small">
												<li><a href="#" class="button special small">Small</a></li>
												<li><a href="#" class="button small">Small</a></li>
												<li><a href="#" class="button alt small">Small</a></li>
											</ul>
										</div>
										<div class="3u 6u(2) 12u$(3)">
											<ul class="actions vertical">
												<li><a href="#" class="button special fit">Default</a></li>
												<li><a href="#" class="button fit">Default</a></li>
												<li><a href="#" class="button alt fit">Default</a></li>
											</ul>
										</div>
										<div class="3u 6u$(2) 12u$(3)">
											<ul class="actions vertical small">
												<li><a href="#" class="button special small fit">Small</a></li>
												<li><a href="#" class="button small fit">Small</a></li>
												<li><a href="#" class="button alt small fit">Small</a></li>
											</ul>
										</div>
									</div>
								</section>

								<section>
									<h4>Table</h4>
									<h5>Default</h5>
									<div class="table-wrapper">
										<table>
											<thead>
												<tr>
													<th>Name</th>
													<th>Description</th>
													<th>Price</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Item One</td>
													<td>Ante turpis integer aliquet porttitor.</td>
													<td>29.99</td>
												</tr>
												<tr>
													<td>Item Two</td>
													<td>Vis ac commodo adipiscing arcu aliquet.</td>
													<td>19.99</td>
												</tr>
												<tr>
													<td>Item Three</td>
													<td> Morbi faucibus arcu accumsan lorem.</td>
													<td>29.99</td>
												</tr>
												<tr>
													<td>Item Four</td>
													<td>Vitae integer tempus condimentum.</td>
													<td>19.99</td>
												</tr>
												<tr>
													<td>Item Five</td>
													<td>Ante turpis integer aliquet porttitor.</td>
													<td>29.99</td>
												</tr>
											</tbody>
											<tfoot>
												<tr>
													<td colspan="2"></td>
													<td>100.00</td>
												</tr>
											</tfoot>
										</table>
									</div>
									
									<h5>Alternate</h5>
									<div class="table-wrapper">
										<table class="alt">
											<thead>
												<tr>
													<th>Name</th>
													<th>Description</th>
													<th>Price</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Item One</td>
													<td>Ante turpis integer aliquet porttitor.</td>
													<td>29.99</td>
												</tr>
												<tr>
													<td>Item Two</td>
													<td>Vis ac commodo adipiscing arcu aliquet.</td>
													<td>19.99</td>
												</tr>
												<tr>
													<td>Item Three</td>
													<td> Morbi faucibus arcu accumsan lorem.</td>
													<td>29.99</td>
												</tr>
												<tr>
													<td>Item Four</td>
													<td>Vitae integer tempus condimentum.</td>
													<td>19.99</td>
												</tr>
												<tr>
													<td>Item Five</td>
													<td>Ante turpis integer aliquet porttitor.</td>
													<td>29.99</td>
												</tr>
											</tbody>
											<tfoot>
												<tr>
													<td colspan="2"></td>
													<td>100.00</td>
												</tr>
											</tfoot>
										</table>
									</div>
								</section>

								<section>
									<h4>Buttons</h4>
									<ul class="actions">
										<li><a href="#" class="button special">Special</a></li>
										<li><a href="#" class="button">Default</a></li>
										<li><a href="#" class="button alt">Alternate</a></li>
									</ul>
									<ul class="actions">
										<li><a href="#" class="button special big">Big</a></li>
										<li><a href="#" class="button">Default</a></li>
										<li><a href="#" class="button alt small">Small</a></li>
									</ul>
									<ul class="actions fit">
										<li><a href="#" class="button special fit">Fit</a></li>
										<li><a href="#" class="button fit">Fit</a></li>
										<li><a href="#" class="button alt fit">Fit</a></li>
									</ul>
									<ul class="actions fit small">
										<li><a href="#" class="button special fit small">Fit + Small</a></li>
										<li><a href="#" class="button fit small">Fit + Small</a></li>
										<li><a href="#" class="button alt fit small">Fit + Small</a></li>
									</ul>
									<ul class="actions">
										<li><a href="#" class="button special icon fa-download">Icon</a></li>
										<li><a href="#" class="button icon fa-download">Icon</a></li>
										<li><a href="#" class="button alt icon fa-check">Icon</a></li>
									</ul>
									<ul class="actions">
										<li><span class="button special disabled">Special</span></li>
										<li><span class="button disabled">Default</span></li>
										<li><span class="button alt disabled">Alternate</span></li>
									</ul>
								</section>

								<section>
									<h4>Form</h4>
									<form method="post" action="#">
										<div class="row uniform">
											<div class="6u 12u(3)">
												<input type="text" name="demo-name" id="demo-name" value="" placeholder="Name" />
											</div>
											<div class="6u 12u(3)">
												<input type="email" name="demo-email" id="demo-email" value="" placeholder="Email" />
											</div>
										</div>
										<div class="row uniform">
											<div class="12u">
												<div class="select-wrapper">
													<select name="demo-category" id="demo-category">
														<option value="">- Category -</option>
														<option value="1">Manufacturing</option>
														<option value="1">Shipping</option>
														<option value="1">Administration</option>
														<option value="1">Human Resources</option>
													</select>
												</div>
											</div>
										</div>
										<div class="row uniform">
											<div class="4u 12u(2)">
												<input type="radio" id="demo-priority-low" name="demo-priority" checked>
												<label for="demo-priority-low">Low Priority</label>
											</div>
											<div class="4u 12u(2)">
												<input type="radio" id="demo-priority-normal" name="demo-priority">
												<label for="demo-priority-normal">Normal Priority</label>
											</div>
											<div class="4u 12u(2)">
												<input type="radio" id="demo-priority-high" name="demo-priority">
												<label for="demo-priority-high">High Priority</label>
											</div>
										</div>
										<div class="row uniform">
											<div class="6u 12u(2)">
												<input type="checkbox" id="demo-copy" name="demo-copy">
												<label for="demo-copy">Email me a copy of this message</label>
											</div>
											<div class="6u 12u(2)">
												<input type="checkbox" id="demo-human" name="demo-human" checked>
												<label for="demo-human">I am a human and not a robot</label>
											</div>
										</div>
										<div class="row uniform">
											<div class="12u">
												<textarea name="demo-message" id="demo-message" placeholder="Enter your message" rows="6"></textarea>
											</div>
										</div>
										<div class="row uniform">
											<div class="12u">
												<ul class="actions">
													<li><input type="submit" value="Send Message" /></li>
													<li><input type="reset" value="Reset" class="alt" /></li>
												</ul>
											</div>
										</div>
									</form>
								</section>

								<section>
									<h4>Image</h4>
									<h5>Fit</h5>
									<span class="image fit"><img src="images/banner.jpg" alt="" /></span>
									<div class="box alt">
										<div class="row 50% uniform">
											<div class="4u"><span class="image fit"><img src="images/pic01.jpg" alt="" /></span></div>
											<div class="4u"><span class="image fit"><img src="images/pic02.jpg" alt="" /></span></div>
											<div class="4u"><span class="image fit"><img src="images/pic03.jpg" alt="" /></span></div>
										</div>
										<div class="row 50% uniform">
											<div class="4u"><span class="image fit"><img src="images/pic02.jpg" alt="" /></span></div>
											<div class="4u"><span class="image fit"><img src="images/pic03.jpg" alt="" /></span></div>
											<div class="4u"><span class="image fit"><img src="images/pic01.jpg" alt="" /></span></div>
										</div>
										<div class="row 50% uniform">
											<div class="4u"><span class="image fit"><img src="images/pic03.jpg" alt="" /></span></div>
											<div class="4u"><span class="image fit"><img src="images/pic01.jpg" alt="" /></span></div>
											<div class="4u"><span class="image fit"><img src="images/pic02.jpg" alt="" /></span></div>
										</div>
									</div>
									<h5>Left &amp; Right</h5>
									<p><span class="image left"><img src="images/avatar.jpg" alt="" /></span>Fringilla nisl. Donec accumsan interdum nisi, quis tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent. Donec accumsan interdum nisi, quis tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent.</p>
									<p><span class="image right"><img src="images/avatar.jpg" alt="" /></span>Fringilla nisl. Donec accumsan interdum nisi, quis tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent. Donec accumsan interdum nisi, quis tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent.</p>
								</section>

							</div>
						</section>

				</div>

			<!-- Footer -->
				<section id="footer">
					<div class="container">
						<ul class="copyright">
							<li>&copy; Nikolas Martens. All rights reserved.</li><li>Design based on: <a href="http://html5up.net" target="_blank">HTML5 UP</a></li>
						</ul>
					</div>
				</section>
			
		</div>

        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-40634631-1', 'auto');
            ga('send', 'pageview');

        </script>
	</body>
</html>