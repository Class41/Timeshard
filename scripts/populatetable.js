var last_table;

function PopulateSessionTable(values, table)
{
    this.val = values;
    for(i = 0; i < values.length; i++)
    {
        row = table.insertRow(1);
        for(j = 0; j < 3; j++) 
        {
            cell = row.insertCell(j);
            cell.innerText = Object.values(val[i])[j]
        }
    }
}

function PullTabledata(tabletype, table)
{
    if (window.XMLHttpRequest)
    {
        xmlhttp=new XMLHttpRequest();
    }
    else
    {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.open("POST","../../scripts/tabledatahandler.php", true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xmlhttp.onreadystatechange = function() 
    {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            PopulateSessionTable(JSON.parse(xmlhttp.responseText), table);
        }
    }
        xmlhttp.send("tabletype=" + tabletype);
}