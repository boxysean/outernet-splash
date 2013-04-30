<?php
include_once "header.php";
include_once "lib/config.php";
?>

        <div class="container">
<?php
if (array_key_exists("a", $_REQUEST)) {
    switch ($_REQUEST["a"]) {
    case "registered":
?>
            <div class="row">
                <div class="span12">
                    <div class="blurb shadow-small notice-success">
                        <h2>Congratulations!</h2>
                        <p>You've registered for the Outernet! Now you can go ahead and post on the <a href="<? echo CLASSIFIEDS_URL; ?>">Outernet Classifieds</a>, or check your Outernet mailbox.</p>
                    </div>
                </div>
            </div>
<?php
        break;
    }
}

if (!array_key_exists("visited", $_SESSION) && !array_key_exists("auth", $_SESSION)) {
?>
            <div class="row">
                <div class="span12">
                    <div class="blurb shadow-small notice-info">
                        <h2>Welcome!</h2>
                        <p>You are NOT on the Internet. This is a neighborhood website that only people on the Outernet hotspots around Brooklyn and Queens can access. <a href="#about">Learn more...</a>
                    </div>
                </div>
            </div>
<?php
    $_SESSION["visited"] = 1;
}
?>
            <div class="row">
                <div class="span2">
<!--                    <div class="blurb shadow-small">
                        <p>Outernet is a local wireless network that connects you with your neighbors, all without using the Internet. <a href="#">More...</a></p>
                    </div>-->
                     <div class="nav-blurb shadow-small">
                        <ul class="nav nav-list">
                            <li><a href="#classifieds">Classifieds <i class="icon-chevron-right"></i></a></li>
                            <li><a href="#announcements">Announcements<i class="icon-chevron-right"></i></a></li>
                            <li><a href="#about">About<i class="icon-chevron-right"></i></a></li>
                            <li><a href="#networkmap">Network map<i class="icon-chevron-right"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="span10">
                    <div class="blurb shadow-small">
                        <a name="classifieds" class="nolink"><h2>Classifieds</h2></a>
                        <p>Classified listings for the neighborhood. Super exclusive!</p>
<?php
$sql = "select
    item.pk_i_id id,
    s_title title,
    date_format(dt_pub_date, '%M %e') date,
    s_contact_name name,
    s_country neighborhood,
    s_region near,
    cat_desc.s_name category,
    cat_parent_desc.s_name parent_category,
    descr.s_description description
from oc_t_item item
    inner join oc_t_item_description descr on (item.pk_i_id = descr.fk_i_item_id)
    inner join oc_t_item_location loc on (item.pk_i_id = loc.fk_i_item_id)
    inner join oc_t_category cat on (item.fk_i_category_id = cat.pk_i_id)
    inner join oc_t_category_description cat_desc on (item.fk_i_category_id = cat_desc.fk_i_category_id)
    inner join oc_t_category_description cat_parent_desc on (cat.fk_i_parent_id = cat_parent_desc.fk_i_category_id)
    where item.b_enabled = 1 and b_active = 1 and b_spam = 0
order by dt_pub_date desc limit 5";

$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
$var = mysql_select_db("osclass");
$r = mysql_query($sql);

$i = 0;

while ($row = mysql_fetch_assoc($r)) {
?>
    <a href='<? echo CLASSIFIEDS_URL; ?>/index.php?page=item&id=<? echo $row['id']; ?>' class='listing <? if ($i % 2 == 0) { echo 'even'; } ?>'>
        <h3><? echo $row['title']; ?></h3>
        <div class="listing-block">
            <p class="listing-header">Listed under</p>
            <p class="listing-content"><? echo $row['parent_category']; ?> (<? echo $row['category']; ?>)</p>
        </div>
        <div class="listing-block">
            <p class="listing-header">Location</p>
            <p class="listing-content"><? echo $row['neighborhood']; ?> near <? echo $row['near']; ?></p>
        </div>
        <div class="listing-block">
            <p class="listing-header">Posted by</p>
            <p class="listing-content"><? echo $row['name']; ?></p>
        </div>
        <div class="listing-block">
            <p class="listing-header">Posted date</p>
            <p class="listing-content"><? echo $row['date']; ?></p>
        </div>
<? /*        <p><? echo $row['description']; ?></p> */ ?>
    </a>

<?php
    $i++;
}

mysql_close($link);

?>
                    </div>
                    <div class="blurb shadow-small">
                        <a name="announcements" class="nolink"><h2>Announcements</h2></a>
                        <p><i>April 28, 2013</i> The Outernet is brand new!</p>
                    </div>
                    <div class="blurb shadow-small">
                        <a name="about" class="nolink"><h2>About</h2></a>
                        <p>The Outernet is a network based in Brooklyn and Queens. You access the Outernet just like how you access the Internet, except there is no regular Internet websites like Facebook, Gmail, and Twitter. Instead, there are the services of the Outernet.</p>
                        <p>The Outernet is a wireless mesh network, meaning that it does not rely on Internet infrastructure to operate. Instead, it uses wireless radios on rooftops to pass data between you and the websites to each other. It's entirely local!</p>
                        <p>Do you have an idea for a Outernet? Do you want to participate further? Contact us at outernetbk@gmail.com (on the real Internet) to get in touch!</p>
                    </div>
                    <div class="blurb shadow-small">
                        <a name="networkmap" class="nolink"><h2>Network map</h2></a>
                        <img src="./images/map.png" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- build:js scripts/front.js -->
    <script data-main="scripts/front" src="components/requirejs/require.js"></script>
    <!-- endbuild -->

<?php include_once "footer.php"; ?>
