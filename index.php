<?php
//error_reporting(0);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Price Parser</title>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<meta property="og:url" content="<?php echo $_SERVER['SCRIPT_URI']?>"/>
		<meta property="og:site_name" content="Sahil Dua"/>
		<meta property="og:title" content="Link Parser"/>
		<meta property="og:image" content="http://sahildua.collegespace.in/link-parser/logo.jpg"/>
		<meta property="og:type" content="website"/>
		<meta property="og:description" content="A simple web-app made to extract all the links from a web page"/>
		<meta name="description" content="A simple web-app made to extract all the links from a web page">
		<meta name="keywords" content="links, parser, extracter, pull links, extract">
		
		<link rel="stylesheet" href="css/style.css"/>
	</head>
	
	<body>
		<div class="container">
			<form action="" method="POST">
				<input type="text" name="link" placeholder="Enter URL for any Flipkart item.." required />
				<input type="submit" name="extract" value="Extract the price" />
			</form>
			
<?php
function isValidURL($url)
{
    return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
}

if(isset($_POST['extract']))
{
	$url = $_POST['link'];
	$len = strlen($url);
		
	if(!isValidURL($url))
	{
		die("* Please enter valid URL including http://<br>");
	}
	
	$html = file_get_contents($url);
	
	$dom = new DOMDocument();
	@$dom->loadHTML($html);
	$classname = 'pprice';
	$finder = new DomXPath($dom);
	$nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
	$tmp_dom = new DOMDocument();
	$innerHTML='';
	foreach ($nodes as $node)
	{
		$tmp_dom->appendChild($tmp_dom->importNode($node,true));
	}
	$innerHTML .= trim($tmp_dom->saveHTML());
	echo $innerHTML;
}
?>
		</div>
		
		<!-- Start of StatCounter Code for Default Guide -->
<script type="text/javascript">
var sc_project=9414391; 
var sc_invisible=1; 
var sc_security="e15d6b40"; 
var scJsHost = (("https:" == document.location.protocol) ?
"https://secure." : "http://www.");
document.write("<sc"+"ript type='text/javascript' src='" +
scJsHost+
"statcounter.com/counter/counter.js'></"+"script>");
</script>
<noscript><div class="statcounter"><a title="web statistics"
href="http://statcounter.com/" target="_blank"><img
class="statcounter"
src="http://c.statcounter.com/9414391/0/e15d6b40/1/"
alt="web statistics"></a></div></noscript>
<!-- End of StatCounter Code for Default Guide -->


		
	</body>
</html>
