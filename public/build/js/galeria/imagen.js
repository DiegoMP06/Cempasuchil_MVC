import{obtenerId}from"../layout/utilidades.js";!function(){!async function(){const t="/api/imagen?id="+obtenerId();try{const i=await fetch(t),n=await i.json();"exito"===n.tipo&&(e=n.imagen,o={...e},document.querySelector("#publico-btn").addEventListener("click",()=>{o.publico="1"===o.publico?"0":"1",async function(t,o){const{id:i,imagen:n,descripcion:a,publico:c,usuarioId:r}=t,s=new FormData;s.append("id",i),s.append("imagen",n),s.append("descripcion",a),s.append("publico",c),s.append("usuarioId",r);try{const t=await fetch("/api/imagen/actualizar",{method:"POST",body:s}),i=await t.json();if("exito"===i.tipo&&(e=i.imagen),Swal.fire(i.tipo.toUpperCase(),i.mensaje.toUpperCase(),"exito"===i.tipo?"success":"error"),"estatus"===o&&"exito"===i.tipo){const t=document.querySelector("#publico-btn");t.classList.toggle("publico"),t.classList.toggle("privado"),t.textContent="0"===e.publico?"No Publicado":"Publicado"}}catch(e){console.error(e)}}(o,"estatus")}),document.querySelector("#eliminar-btn").addEventListener("click",()=>{Swal.fire({title:"Atencion".toUpperCase(),text:"Deseas Eliminar la Imagen".toUpperCase(),icon:"question",showCancelButton:!0,confirmButtonColor:"#d33",cancelButtonColor:"#3085d6",cancelButtonText:"No",confirmButtonText:"Si"}).then(t=>{t.isConfirmed&&async function(){const{id:t}=e,o=new FormData;o.append("id",t);try{const e=await fetch("/api/imagen/eliminar",{method:"POST",body:o}),t=await e.json();Swal.fire(t.tipo.toUpperCase(),t.mensaje.toUpperCase(),"exito"===t.tipo?"success":"error"),"exito"===t.tipo&&setTimeout(()=>{window.location="/galeria"},2e3)}catch(e){console.error(e)}}()})}))}catch(e){console.error(e)}var o}();let e={}}();