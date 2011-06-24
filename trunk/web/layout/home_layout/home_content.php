<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<div class="container" style="border-style: solid">
    <div class="content" style="width: 965; border-style: solid">
        <div class="content">
            <button onclick="buttonOnClick('layout/general_layout/homecontent_layout.php','ajax_wrapper')">HOME</button>
        </div>
        <div class="content">
            <button onclick="buttonOnClick('layout/general_layout/product_layout.php','ajax_wrapper')">PRODUK</button>
        </div>
        <div class="content">
            <button onclick="buttonOnClick('layout/general_layout/about_layout.php','ajax_wrapper')">ABOUT</button>
        </div>
        <div class="content">
            <button onclick="buttonOnClick('layout/general_layout/contact_layout.php','ajax_wrapper')">KONTAK</button>
        </div>
        <div class="content">
            <button onclick="buttonOnClick('layout/general_layout/homecontent_layout.php','ajax_wrapper')">POI MANAGEMENT</button>
        </div>
        <div class="content">
            <button onclick="buttonOnClick('layout/general_layout/homecontent_layout.php','ajax_wrapper')">USER MANAGEMENT</button>
        </div>
        <div class="content">
            <form action="process/logout.php" method="POST">
                <button>LOGOUT</button>
            </form>
        </div>
    </div>
    <div class="content" style="width: 965; border-style: solid">
        ini isinya, pake ajax?
        <div id="ajax_wrapper">
            
        </div>
    </div>
    <div class="clearboth"></div>
</div>
