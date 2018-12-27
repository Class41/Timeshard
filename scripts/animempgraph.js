var targetHours = 40;
var currentHours = 41;

function setCurrentHours(val) 
{
    currentHours = val;
}

function setTargetHours(val) 
{
    targetHours = val;
}

function setHours(curr, target) 
{
    currentHours = curr;
    targetHours = target;
}


var bar = new ProgressBar.SemiCircle(document.getElementById("empgraph"), {
    strokeWidth: 5,
    color: '#34495e',
    trailColor: '#34495e',
    trailWidth: 1,
    easing: 'easeInOut',
    duration: 500,
    svgStyle: null,
    text: {
        value: '?/?',
        alignToBottom: true
    },
    from: {color: '#e74c3c'},
    to: {color: '#27ae60'},
    step: (state, bar) => {
        bar.path.setAttribute('stroke', state.color);
        var value = Math.round(bar.value() * targetHours);
        if (value === 0) {
        bar.setText('');
        } else {
            if(currentHours > targetHours)
                bar.setText(currentHours + "/" + targetHours + " hours");
            else
                bar.setText(value + "/" + targetHours + " hours");
        }

        bar.text.style.color = state.color;
    }
    });

bar.text.style.fontFamily = '"Muli", sans-serif';
bar.text.style.fontSize = '1.35rem';

function CalcBar()
{
        if (currentHours <= targetHours)
        { 
            return currentHours/targetHours;
        }
        else
        {
            return 1.0;
        }
}

bar.animate(CalcBar());