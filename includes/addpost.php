<?php
require('db.php');
if(isset($_POST['addpost'])){
   $ptitle=mysqli_real_escape_string($db,$_POST['post_title']);
   $psummary = mysqli_real_escape_string($db,$_POST['post_summary']);
   $pcontent=mysqli_real_escape_string($db,$_POST['post_content']);
   $cid1=$_POST['post_category1'];
   $cid2=$_POST['post_category2'];
   $cid3=$_POST['post_category3'];
   $query="INSERT INTO posts (title,content,category_id,summary,category_id2,category_id3) VALUES('$ptitle','$pcontent',$cid1,'$psummary',$cid2,$cid3)";
$run=mysqli_query($db,$query);
$post_id=mysqli_insert_id($db);
echo '<PRE>';
$image_name=$_FILES['post_image']['name'];
$img_tmp=$_FILES['post_image']['tmp_name'];
print_r($image_name);
print_r($img_tmp);

foreach($image_name as $index=>$img){
    if(move_uploaded_file($img_tmp[$index],"../images/$img")){
        $query="INSERT INTO images (post_id,image) VALUES($post_id,'$img')";
$run=mysqli_query($db,$query); 
    }
}

header('location:../admin/index.php?managepost');


}
?>