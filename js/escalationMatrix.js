// JS File for Escalation Matrix

let file = ['escalationMatrix'];
let page = window.location.href.split('/');


// Page code only if href match with the file const

if(file[0] === page[4]){
    

        const matrixElements = {
            matrixForm              :   document.querySelector('#matrixForm'),
            matrixHeader            :   document.querySelector('#matrixHeader'),
            matrixUnidades          :   document.querySelector('#matrixUnidades'),
            matrixSubunidades       :   document.querySelector('#matrixSubunidades'),
            matrixFecha             :   document.querySelector('#matrixFecha'),
            matrixId                :   document.querySelector('#matrixId'),
            matrixKpi               :   document.querySelector('#matrixKpi'),
            matrixMeta              :   document.querySelector('#matrixMeta'),
            matrixResultado         :   document.querySelector('#matrixResultado'),
            matrixAlerta            :   document.querySelector('#matrixAlerta'),
            matrixEnviar            :   document.querySelector('#matrixEnviar'),
        }

        let enviarAlerta = false; 
        //Crea la lista de unidades
        const lista = matrixElements.matrixUnidades;
        const listaS = matrixElements.matrixSubunidades
        const kpi = matrixElements.matrixKpi
        const resultado = matrixElements.matrixResultado
        const alerta = matrixElements.matrixAlerta


    class EmController {
        constructor(a, b, c, d, e, f) {
            this.a = a;
            this.b = b;
            this.c = c;
            this.d = d;
            this.e = e;
            this.f = f;

        }


        guidGenerator() {
            var S4 = function() {
               return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
            };
            return (S4());
        }


        formInfo(a) {

            //Create the from with the data to fetch
            let datos = new FormData();
            datos.append(a, a);
            fetch('fetch/escalationMatrix.fetch.php', {
                method: 'POST',
                body: datos
            })

            .then(res => res.json())
            .then(data => {
                
                //Elimina duplicados de las unidades           
                let unidades = [`<option class="bg bg-white text-muted mt-n1" value="">Seleccionar...</option>`], unidad, temp
                for(let i = 0; i < data.length; i ++) {
                    if (unidad != data[i].unidad && data[i].activo == 1) {
                        temp = data[i].unidad;
                        //Agrega a la variable el elemento de DOM option
                        unidades.push(`<option class="bg bg-white text-muted mt-n1" value="${temp}">${temp}</option>`);
                    }
                    unidad = temp;
                }

                // Create Id and alert date
                matrixElements.matrixId.value = this.guidGenerator();
                let date = new Date() ;
                matrixElements.matrixFecha.value = date.getDate() + '-' + String(date).substring(4, 7) + '-' + date.getFullYear();
                
               
                
                lista.innerHTML = unidades;

                //Create subunits list
                lista.addEventListener('change', () => {
                    let unidadActiva = lista.options[lista.selectedIndex].value;
                    listaS.removeAttribute('disabled');
                    listaS.innerHTML = `<option class="bg bg-white text-muted mt-n1" value="0">Seleccionar...</option>`;
                    kpi.innerHTML = `<option class="bg bg-white text-muted mt-n1" value="0">Seleccionar...</option>`;
                    resultado.value = '';

                    for(a of data) {
                        if(unidadActiva == a.unidad && a.activo == 1) {
                            listaS.insertAdjacentHTML('beforeend', `<option class="bg bg-white text-muted mt-n1" numero="${a.id}" value="${a.subunidad}">${a.subunidad}</option>`)
                        }
                    }


                })
                
                //Create KPI List
                listaS.addEventListener('change', () => {
                    const subunidadActiva = listaS.options[listaS.selectedIndex].getAttribute('numero');
                    let datosA = new FormData();
                    datosA.append('subunidad', subunidadActiva);
                    
                    fetch('fetch/escalationMatrix.fetch.php', {
                        method: 'POST',
                        body: datosA
                    })
        
                    .then(res => res.json())
                    .then(data => {
                        if(data.length > 1) {
                            kpi.removeAttribute('disabled');
                        }
                        
                        kpi.innerHTML = `<option class="bg bg-white text-muted mt-n1" value="0">Seleccionar...</option>`;
                        resultado.value = '';
                        for(a of data) {
                            if(a.activo == '1') {
                                kpi.insertAdjacentHTML('beforeend', `<option class="bg bg-white text-muted mt-n1" roja="${a.roja}" naranja="${a.naranja}" amarilla="${a.amarilla}" unidadMedida="${a.unidadMedida}" meta="${a.meta}" multiplicador="${a.multiplicador}" value="${a.kpi.toUpperCase()}">${a.kpi.toUpperCase()}</option>`)
                            }
                            
                        }
                    })
                })

                //Imprimir la meta de KPI seleccionado
                kpi.addEventListener('change', () => {
                    resultado.removeAttribute('readonly');
                    resultado.value = '';
                    const tipoDato = kpi.options[kpi.selectedIndex].getAttribute('unidadMedida');
                    if(tipoDato === 'porcentaje') {
                        matrixElements.matrixMeta.value = parseFloat((kpi.options[kpi.selectedIndex].getAttribute('meta')) * 100);
                    } else {
                        matrixElements.matrixMeta.value = parseFloat((kpi.options[kpi.selectedIndex].getAttribute('meta')));
                    }
                    
                })
                

                // Colorear alerta
                const eventListeners = ['keyup', 'change']
                
                let color = 'cumple';
                eventListeners.forEach(evt => 
                    resultado.addEventListener(evt, () => {
                        const multiplicador = parseInt(kpi.options[kpi.selectedIndex].getAttribute('multiplicador'));
                        const roja = parseFloat(kpi.options[kpi.selectedIndex].getAttribute('roja')) * 1000 * multiplicador ; // Se multiplica para obtener un valor que supere siempre el rojo queno ponga limite al rojo
                        const naranja = parseFloat(kpi.options[kpi.selectedIndex].getAttribute('naranja')) * multiplicador;
                        const amarilla = parseFloat(kpi.options[kpi.selectedIndex].getAttribute('amarilla')) * multiplicador;
                        const meta  = parseFloat(kpi.options[kpi.selectedIndex].getAttribute('meta')) * multiplicador;
                        const unidadMedida  = kpi.options[kpi.selectedIndex].getAttribute('unidadMedida');
                        
    
                        let x = parseFloat(resultado.value);
                        (unidadMedida === 'porcentaje') ? x = x / 100 * multiplicador : x = x * multiplicador
                        
                      

                        if(x >= roja && x < naranja){
                            enviarAlerta = true;
                            color = 'roja'
                        } else if(x >= naranja && x < amarilla){
                            enviarAlerta = true;
                            color = 'naranja'
                        } else if(x >= amarilla && x < meta){
                            enviarAlerta = true;
                            color = 'amarilla'
                        } else if(x >= meta){
                            enviarAlerta = false;
                            color = 'cumple'
                        }


                        

                        let colores = ['cumple', 'roja', 'naranja', 'amarilla'];
                        let borde = ['bg-info', 'bg-danger', 'bg-warning', 'bg-warning'];
                        let fondo = ['bg-info', 'bg-danger', 'bg-warning', 'bg-warning'];
                        alerta.classList.remove('bg-danger','bg-warning','bg-warning');
                        alerta.classList.add(borde[colores.indexOf(color)]);
                        alerta.value = color.replace(/^\w/, c => c.toUpperCase());
                        matrixElements.matrixHeader.innerHTML = `
                            <div class="card-header bg ${fondo[colores.indexOf(color)]} text-white">
                                <h3>Alerta ${color.replace(/^\w/, c => c.toUpperCase())} <i class="float-right" data-feather="alert-triangle" style="width: 30px; height: 30px;"></i></h3>
                            </div>
                        `;
                        feather.replace();
                    })    
                )

            })

            .catch(error => console.error('Error: ', error))   
            
        }


        formSend() {
            matrixElements.matrixEnviar.addEventListener('click', (e) => {
                e.preventDefault();
                if(enviarAlerta){
                        // Create a formData with the form info
                    let go = false;
                    let data = new FormData(matrixElements.matrixForm);
                    for(let a of data) {
                        // console.log(a[0], ': ', a[1].length)
                        if(a[1].length === 0) {
                            go = false;
                            break
                        } else {
                            go = true;
                        }
                    }

                    if(go){

                        fetch('fetch/escalationMatrix.fetch.php', {
                            method: 'POST',
                            body: data
                        })
                        .then(res => res.json())
                        .then(data => {
                            
                            // Do something whit the data
                            Swal.fire({
                                html: '<span class="ml-n3  py-4 text-white">Alerta enviada exitosamente.</span>',
                                timer: 3000,
                                background: 'rgb(46, 204, 113)',
                                // toast: true,
                                position: "center",
                                showConfirmButton: false
                            })
                            setTimeout(() => {
                                window.location.reload();
                            }, 3000) 

                        })


                        //Envio PHP Mailer
                        const id = listaS.options[listaS.selectedIndex].getAttribute('numero');
                        let dataF = new FormData()
                        dataF.append('subunidad', id)

                        fetch('fetch/escalationMatrix.fetch.php', {
                            method: 'POST',
                            body: dataF
                        })

                        .then(res => res.json())
                        .then(data => {
                            
                            let mail = []
                            let mascara
                            for(let a of data) {
                                
                                mascara = a.mascaraMail
                                let nivel = document.querySelector('#matrixAlerta').value.toLowerCase()
                                if(nivel === 'amarilla') {
                                    mail = [a.mailAmarilla]
                                } else if(nivel === 'naranja') {
                                    mail = [a.mailAmarilla, a.mailNaranja]
                                } else if(nivel === 'roja') {
                                    mail = [a.mailAmarilla, a.mailNaranja, a.mailRoja]
                                } else {
                                    mail = []
                                }
                            }

                            if(mail) {
                                mail = mail.toString().split(',').join(';')
                                let mailer = new FormData(matrixElements.matrixForm)
                                mailer.append('destinatarios', mail)
                                mailer.append('mascara', mascara)
                                fetch('fetch/escalationMail.fetch.php', {
                                    method: 'POST',
                                    body: mailer
                                })
                            }  
                        })

                        .catch(error => console.error('Error:', error));


                    } else  {
                        
                        Swal.fire({
                            title: "Error!:",
                            text: "Todos los campos son obligatorios",
                            type: "error",
                            timer: 4000,
                            toast: true,
                            position: "center",
                            showConfirmButton: false
                        })
                    }
                } else {
                    Swal.fire({
                        title: "Error!:",
                        text: "No es posible reportar una alerta si se cumple el indicador",
                        type: "error",
                        timer: 4000,
                        toast: true,
                        position: "center",
                        showConfirmButton: false
                    })
                }
            
            })

        }


        
    } // End of class









    const matrixController = new EmController();
    matrixController.formInfo('unidades');
    matrixController.formSend();
    
    















} // End of file validation