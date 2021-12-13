var tabButtons=document.querySelectorAll(".tabContainer .buttonContainer button");
var tabPanels = document.querySelectorAll(".tabContainer .tabPanel");

function showPanel(panelIndex,ColorCode){
    tabButtons.forEach(function(node){
        node.style.backgroundColor=ColorCode;
    });
    tabPanels.forEach(function(node){
        node.style.display="none";
    });
    tabPanels[panelIndex].style.display="block";

}