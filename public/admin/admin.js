function showTooltip() {
    alert('دة عدد البلاغات يا معلم');
}

function ignoreFilm(uid){
    console.log(uid);
    axios.post('ignore.php',{uid: uid}).then(function (response){
        console.log(response.data.success);
    });
}

function removeFilm(uid){
    axios.post('remove.php',{uid: uid}).then(function (){

    });
}