function PopulateSessionTable()
{
    table = document.getElementById("sessiontable");

    for(i = 0; i < 10; i++)
    {
        row = table.insertRow(1);
        for(j = 0; j < 3; j++) 
        {
            cell = row.insertCell(j);
            cell.innerText = "Bob " + i + " " + j;
        }
    }
}

tableobj = {
            type:-1
            }

function PullTabledata()
{
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

    xmlhttp.onreadystatechange = function() 
    {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
        }
    }

        xmlhttp.send("shard=" + shard);
}