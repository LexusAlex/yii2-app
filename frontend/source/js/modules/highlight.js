
hljs.configure({"tabReplace":" ","useBR":false});
var elements = document.querySelectorAll('pre');
Array.prototype.forEach.call(elements, function(block, i){
    hljs.highlightBlock(block);
});
hljs.initHighlightingOnLoad();
