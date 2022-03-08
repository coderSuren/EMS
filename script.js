function dashboard(){
        document.getElementById('home-content').innerHTML=document.getElementById('dashboard').innerHTML;
        var x=document.getElementsByTagName('a');
        for(i=0;i<x.length;i++){
          document.getElementsByTagName('a')[i].classList.remove("active");
        }
        document.getElementById('nav1').className+= 'active';
}
function guidelines(){
        document.getElementById('home-content').innerHTML=document.getElementById('Guidelines').innerHTML;
        var x=document.getElementsByTagName('a');
        for(i=0;i<x.length;i++){
          document.getElementsByTagName('a')[i].classList.remove("active");
        }
        document.getElementById('nav2').className+= 'active';
}
function report(){
        document.getElementById('home-content').innerHTML=document.getElementById('report').innerHTML;
        var x=document.getElementsByTagName('a');
        for(i=0;i<x.length;i++){
          document.getElementsByTagName('a')[i].classList.remove("active");
        }
        document.getElementById('nav3').className+= 'active';
}
function asset(){
        document.getElementById('home-content').innerHTML=document.getElementById('asset').innerHTML;
        var x=document.getElementsByTagName('a');
        for(i=0;i<x.length;i++){
          document.getElementsByTagName('a')[i].classList.remove("active");
        }
        document.getElementById('nav4').className+= 'active';
}
function profile(){
        document.getElementById('home-content').innerHTML=document.getElementById('profile').innerHTML;
        var x=document.getElementsByTagName('a');
        for(i=0;i<x.length;i++){
          document.getElementsByTagName('a')[i].classList.remove("active");
        }
        document.getElementById('nav5').className+= 'active';
}
function logout(){
        alert("Logged Out Successfully");
}

function dropdown1() {
        var y=document.getElementById('test-report').style.display;
        if (y=='none'){
                document.getElementById('test-report').style.display='';
                document.getElementById('drop1').className='bx bxs-down-arrow';
        }
        else{
                document.getElementById('test-report').style.display='none'; 
                document.getElementById('drop1').className='bx bxs-right-arrow';      
        }
}

function dropdown2() {
        var y=document.getElementById('patient-report').style.display;
        if (y=='none'){
                document.getElementById('patient-report').style.display='';
                document.getElementById('drop2').className='bx bxs-down-arrow';
        }
        else{
                document.getElementById('patient-report').style.display='none'; 
                document.getElementById('drop2').className='bx bxs-right-arrow';      
        }
}

function dropdown3() {
        var y=document.getElementById('migrant-report').style.display;
        if (y=='none'){
                document.getElementById('migrant-report').style.display='';
                document.getElementById('drop3').className='bx bxs-down-arrow';
        }
        else{
                document.getElementById('migrant-report').style.display='none'; 
                document.getElementById('drop3').className='bx bxs-right-arrow';      
        }
}

function dropdown4() {
        var y=document.getElementById('critical-report').style.display;
        if (y=='none'){
                document.getElementById('critical-report').style.display='';
                document.getElementById('drop4').className='bx bxs-down-arrow';
        }
        else{
                document.getElementById('critical-report').style.display='none'; 
                document.getElementById('drop4').className='bx bxs-right-arrow';      
        }
}