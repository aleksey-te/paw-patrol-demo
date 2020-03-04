<head>
<title>PAW Patrol's Official Website</title>
<meta name="description" content="Led by 10-year-old Ryder, the plucky pups of PAW Patrol are rescue dogs in training. Each pup is inspired by a real-world job like fire fighter, police officer, and construction worker. When trouble strikes Adventure Bay, they&#39;re there to save the day! Whether it&#39;s a cat in a tree or a train off the tracks, they always find a way to help those in need.">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="assets/production.min.css" rel="stylesheet"/>
<link href="assets/jquery-ui.css" rel="stylesheet"/>
<link href="assets/jquery.fancybox.min.css" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css?family=Alfa+Slab+One|Holtwood+One+SC|Vollkorn:400,900|Lato:400,700&amp;subset=latin-ext" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap" rel="stylesheet">
<script src="./assets/production.min.js"></script>

<?php if ($response) { ?>
    <script>
        console.log(JSON.stringify(JSON.parse("<?php echo addslashes($response);?>"), null, 2))
    </script>
<?php } ?>
</head>
