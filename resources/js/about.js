//window.onload should make this function run when the page is loaded.
window.onload = function(){  
    //summary tags have the class "accordion-header". This should add a click listener to run this function when the user clicks one of the light blue headings.
    document.getElementByClassName("accordion-header").addEventListener("click", function toggleIcon(){
        //for testing purposes
        console.log("function called!");
        //this is the div that has the V shaped triangle. I want it to be a ^ when it is open to show user they can close by clicking it again.
        var curr = document.getElementByClassName("toggle").innerHTML;
        
        //&#9660 is the HTML character code for the downwards triangle, &#9650 is for the upwards one.
        if (curr == "&#9660"){ //if downward triangle, switch to upwards
            document.getElementByClassName("toggle").innerHTML = "&#9650";
        }else{ //if upwards triangle, switch to downwards
            document.getElementByClassName("toggle").innerHTML = "&#9660";
        }
    } );
}
