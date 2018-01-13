<html>
<body>

<form action="upload_file.php" method="post"
enctype="multipart/form-data">
<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
    Choose a file to upload: <input name="uploaded_file" type="file" />
    <input type="submit" value="Upload" />
  </form> 
</body> 
</html>