import insertText from "https://cdn.jsdelivr.net/npm/insert-text-at-cursor@0.3.0/index.js";



var emojiEvent =  document.getElementsByTagName("emoji-picker")


for (const eme of emojiEvent) {
    eme.addEventListener("emoji-click", (e) => {
        insertText( document.getElementById("message"),e.detail.unicode );
    });
    
    
}

