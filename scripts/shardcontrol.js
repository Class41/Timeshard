var shardactive = false;

function ToggleShard(button) {
    selection = document.getElementById("taskselector");

    shardobj = {
        conntype: -1,
        shardtype: "",
        memoval: ""
    }

    if(selection.value != "Select Task")
    {
        shardactive = !shardactive;
        if(shardactive)
        {
            button.value = "End";

            button.classList.add("buttonroundred");
            button.classList.remove("buttongreen");

            shardobj.conntype = 0;
            shardobj.shardtype = selection.value;
            FireShard(shardobj);

            selection.disabled = true;
        }
        else
        {
            button.value = "Begin";
            button.classList.add("buttongreen");
            button.classList.remove("buttonroundred");

            selection.disabled = false;

            memo = document.getElementById("shardmemo");
            shardobj.conntype = 1;
            shardobj.memoval = memo.value;

            FireShard(shardobj);

            memo.value = "";
            UpdateCounter(memo);
        }
    }

}

function FireShard(shard)
{
    shard = JSON.stringify(shard);

    if (window.XMLHttpRequest)
    {
        xmlhttp=new XMLHttpRequest();
    }
    else
    {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.open("POST","../../scripts/shardhandler.php", true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xmlhttp.onreadystatechange = function() {
        console.log(xmlhttp.readyState);
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            alert(xmlhttp.responseText);
        }
    }

    xmlhttp.send("shard=" + shard);
}

function UpdateCounter(memo) {
    var counter = document.getElementById("inputcount");
    
    counter.innerText = memo.value.length + "/100" 
}