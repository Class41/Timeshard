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

    //console.log(values);
    //console.log(initval);

    for(i = initval; i >= 0; i--)
    {
        row = table.insertRow(1);
        for(j = 0; j < 3; j++) 
        {
            cell = row.insertCell(j);
            cell.innerText = Object.values(values[i])[j]
        }
    }

    while(table.rows.length > 10)
    {
        table.deleteRow(table.rows.length - 1);
    }
}

var dataQueue = [];
var dataTransmit = false;

function PullTabledata(tabletype, table, init, dequeued = false)
{
    dataQueue.push([tabletype, table, init]);

    if(dataQueue.length == 1 && dataTransmit == false)
    {
        dataQueue.shift();
        dataTransmit = true;
    }
    else if (dequeued == true)
    {
        dataTransmit = true;
    }
    else
    {
        return;
    }

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
                dataTransmit = false;

                if(dataQueue.length > 0)
                {
                    var param = dataQueue.shift();
                    PullTabledata(param[0], param[1], param[2], true);
                }

            } catch (e){}
        }
    }
        xmlhttp.send("tabletype=" + tabletype);
}