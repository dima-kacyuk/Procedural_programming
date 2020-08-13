
var modal = document.querySelector('.modal')
var overflow = document.createElement('div')
function openWin(getId) 
        overflow.className = "overflow"
        document.body.appendChild(overflow)
        var height = modal.offsetHeight
        modal.style.marginTop = - height / 2 + "px"
        modal.style.top = "50%"
        <?php
            session_start()
            $_SESSION['id_news'] = "getId.id"
            //$id_news = "getId.id"
        ?>

if (!Element.prototype.remove) 
        Element.prototype.remove = function remove() 
                if (this.parentNode) 
                        this.parentNode.removeChild(this)
                }
            
        };
    

overflow.onclick = function () {
        modal.style.top = "-100%";
        overflow.remove();
}