var shardactive = false;

shardobj = {
    conntype: -1,
    shardtype: "",
    memoval: ""
}

var selection, button;

function GetShardStatus()
{
    this.selection = document.getElementById("taskselector");
    this.button = document.getElementById("shardbutton");

    shardobj.conntype = 2;
    FireShard(shardobj);
}

function SetShardActive()
{
    button.value = "End";
    button.classList.add("buttonroundred");
    button.classList.remove("buttongreen");

    selection.disabled = true;

    shardactive = true;
}

function SetShardInactive()
{
    button.value = "Begin";
    button.classList.add("buttongreen");
    button.classList.remove("buttonroundred");

    selection.disabled = false;

    shardactive = false;
}

function ToggleShard() 
{
    if(selection.value != "Select Task")
    {
        if(!shardactive)
        {
            
            SetShardActive();
            shardobj.conntype = 0;
            shardobj.shardtype = selection.value;
            FireShard(shardobj);
        }
        else
        {
            SetShardInactive();
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
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            console.log(JSON.parse(xmlhttp.responseText));
            if(response = JSON.parse(xmlhttp.responseText))
            {
                if(response[0] == "102")
                {
                    SetShardActive();
                    
                    for (i = 0; i < selection.children.length; i++)
                    {
                        if(selection.children[i].value == response[1])
                        {
                            selection.children[i].selected = true;
                            return;
                        }
                    }

                }
                else if(response[0] == "103")
                {
                    SetShardInactive();
                }
            }
        }
    }

    xmlhttp.send("shard=" + shard);
}

function UpdateCounter(memo) {
    var counter = document.getElementById("inputcount");
    
    counter.innerText = memo.value.length + "/100" 
}