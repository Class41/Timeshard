function PopulateSessionTable(values, table, init)
{
    if(init == true)
    {
        initval = values.length - 1;
    }
    else if(init == false)
    {
        initval = 0;
    }

    console.log(values);
    console.log(initval);

    for(i = initval; i >= 0; i--)
    {
        row = table.insertRow(1);
        for(j = 0; j < 3; j++) 
        {
            cell = row.insertCell(j);
            cell.innerText = Object.values(values[i])[j]
        }
    }
}

function PullTabledata(tabletype, table, init)
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
            try 
            {
                PopulateSessionTable(JSON.parse(xmlhttp.responseText), table, init);
            } catch (e){}
        }
    }
        xmlhttp.send("tabletype=" + tabletype);
}