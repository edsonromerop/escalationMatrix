window.addEventListener('load', () => {

    try {

        // JS File for Escalation Matrix

        file = ['escalationSetup'];
        page = window.location.href.split('/');


        // Page code only if href match with the file const

        if(file[0] === page[4]){
            

            const matrixElements = {
                unidades          :   document.querySelector('#matrixUnidades'),
                subunidades       :   document.querySelector('#matrixSubunidades'),
                asignados         :   document.querySelector('#matrix_KpiAsignados'),
                noAsignados       :   document.querySelector('#matrix_KpiNoAsignados'),
                btnSetup          :   document.querySelector('#matrix_btnSetup'),
                formSetup         :   document.querySelector('#matrix_formSetup'),
                matrixMail        :   document.querySelector('#matrix_Mail'),
                mailRoja          :   document.querySelector('#matrix_mailRoja'),
                mailNaranja       :   document.querySelector('#matrix_mailNaranja'),
                mailAmarilla      :   document.querySelector('#matrix_mailAmarilla'),
                matrixEditMail    :   document.querySelectorAll('.matrix_EditMail'),
                matrixSetupMail   :   document.querySelector('#matrix_setupMail'),
                matrixUpdateMail   :   document.querySelector('#matrix_updateMail'),
            }

            const {unidades, subunidades, asignados, noAsignados, btnSetup, formSetup, mailRoja, mailNaranja, mailAmarilla, matrixEditMail, matrixSetupMail, matrixUpdateMail} = matrixElements;
                


            class EmSController {

                constructor(a, b, c) {
                    this.a = a;
                    this.b = b;
                    this.c = c;
                }

                async unidades(a) {

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
                        let lista = [`<option class="bg bg-white text-muted mt-n1" value="">Seleccionar...</option>`], elemento, temp
                        for(let i = 0; i < data.length; i ++) {
                            if (elemento != data[i].unidad) {
                                temp = data[i].unidad;
                                //Agrega a la variable el elemento de DOM option
                                lista.push(`<option class="bg bg-white text-muted mt-n1" value="${temp}">${temp}</option>`);
                            }
                            elemento = temp;
                        }
                    
                        unidades.innerHTML = lista;

                        //Create subunits list
                        unidades.addEventListener('change', () => {
                            let unidadActiva = unidades.options[unidades.selectedIndex].value;
                            asignados.innerHTML = '';
                            subunidades.removeAttribute('disabled');
                            subunidades.innerHTML = `<option class="bg bg-white text-muted mt-n1" value="0">Seleccionar...</option>`;
                            for(a of data) {
                                if(unidadActiva == a.unidad) {
                                    subunidades.insertAdjacentHTML('beforeend', `<option class="bg bg-white text-muted mt-n1" numero="${a.id}" value="${a.kpi}">${a.subunidad}</option>`)
                                }
                            }
                        })
                    })

                    .catch(error => console.error('Error: ', error))
                    await this.subunidades();

                }

                subunidades(){
                    //Create KPI List
                    subunidades.addEventListener('change', () => {
                        const subunidadActiva = subunidades.options[subunidades.selectedIndex].getAttribute('numero');
                        let datosA = new FormData();
                        datosA.append('subunidad', subunidadActiva);

                        fetch('fetch/escalationMatrix.fetch.php', {
                            method: 'POST',
                            body: datosA
                        })
            
                        .then(res => res.json())
                        .then(data => {
                            asignados.innerHTML = '';
                            
                            for(let a of data){
                              this.addKpi(a);
                            }

                            let btn = document.querySelectorAll('.btnSetup');
                            btn.forEach(el => {
                                el.addEventListener('click', () => {
                                    this.updateKpi(el.getAttribute('formId'), subunidadActiva)
                                })
                            })
                            
                            this.renderMail(data);
                            feather.replace(); 
                        })

                        

                           
                    })
                    
                }

                addKpi(a){
                    asignados.insertAdjacentHTML('beforeend',  `
                    <div class="card">
                        <div class="card-header bg bg-light">
                            ${a.kpi}
                        </div>
                        <div class="card-body">
                            <form id="form${a.idkpi}">
                                <div class="form-group d-flex">
                                    <label class="mx-1" for="">Meta</label><input data-toggle="tooltip" data-placement="top" title="No es necesario agregar '%' para datos de porcentaje." type="number" class="form-control" name="meta" id="matrixMeta" value="${a.unidadMedida === 'porcentaje' ? (a.meta * 100).toFixed(2) :  (a.meta * 1).toFixed(0)}">
                                    <label class="mx-1" for="">Roja</label><input data-toggle="tooltip" data-placement="top" title="No es necesario agregar '%' para datos de porcentaje." type="number" class="form-control" name="roja" id="matrixMeta" value="${a.unidadMedida === 'porcentaje' ? (a.roja * 100).toFixed(2) :  (a.roja * 1).toFixed(0)}">
                                    <label class="mx-1" for="">Naranja</label><input data-toggle="tooltip" data-placement="top" title="No es necesario agregar '%' para datos de porcentaje." type="number" class="form-control" name="naranja" id="matrixMeta" value="${a.unidadMedida === 'porcentaje' ? (a.naranja * 100).toFixed(2) :  (a.naranja * 1).toFixed(0)}">
                                    <label class="mx-1" for="">Amarilla</label><input data-toggle="tooltip" data-placement="top" title="No es necesario agregar '%' para datos de porcentaje." type="number" class="form-control" name="amarilla" id="matrixMeta" value="${a.unidadMedida === 'porcentaje' ? (a.amarilla * 100).toFixed(2) :  (a.amarilla * 1).toFixed(0)}">
                                    <input type="hidden" class="form-control" name="id" value="${a.idkpi}">
                                    <input type="hidden" class="form-control" name="tipo" value="${a.unidadMedida}">
                                    <button type="button" class="ml-4 btn btn-info btnSetup" formId="${a.idkpi}"><i data-feather="refresh-cw"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    `)

                }

                updateKpi(a, b){
                    const form = document.querySelector('#form' + a)
                    const data = new FormData(form)
                    data.append('sub', b)
                    data.append('updateKpi', 'updateKpi')

                    fetch('fetch/escalationMatrix.fetch.php', {
                        method: 'POST',
                        body: data
                    })

                    .then(res => res.json())
                    .then(data => {
                        let validador = false;
                        asignados.innerHTML = '';
                        for(let a of data){
                            if(a.actualizado === '1'){
                                validador = true;
                                this.addKpi(a);
                            }
                        }

                        if(validador){
                            Swal.fire({
                                html: '<span class="ml-n3 text-white">Indicador actualizado.</span>',
                                timer: 3000,
                                background: 'rgb(214, 60, 60)',
                                toast: true,
                                position: "center",
                                showConfirmButton: false
                            })
                        } else {
                            Swal.fire({
                                title: "Error!:",
                                text: "Se han presentado errores.",
                                type: "error",
                                timer: 3000,
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false
                            })
                        }

                        let btn = document.querySelectorAll('.btnSetup');
                            btn.forEach(el => {
                                el.addEventListener('click', () => {
                                    this.updateKpi(el.getAttribute('formId'), b)
                                })
                        })
                        feather.replace(); 
                    })

                }

                renderMail (){
                    const id = subunidades.options[subunidades.selectedIndex].getAttribute('numero');
                    let datosB = new FormData();
                    datosB.append('subunidad', id);

                    fetch('fetch/escalationMatrix.fetch.php', {
                        method: 'POST',
                        body: datosB
                    })
        
                    .then(res => res.json())
                    .then(data => {

                        let rj, na, am 

                        for(let a of data){
                            mailRoja.innerHTML = ''
                            mailNaranja.innerHTML = ''
                            mailAmarilla.innerHTML = ''
                            rj = a.mailRoja
                            na = a.mailNaranja
                            am = a.mailAmarilla
                        }
                        
                        this.listMail(am).forEach(el => mailAmarilla.insertAdjacentHTML('beforeend', `<li class="list-group-item">${el}</li>`))
                        this.listMail(na).forEach(el => mailNaranja.insertAdjacentHTML('beforeend', `<li class="list-group-item">${el}</li>`))
                        this.listMail(rj).forEach(el => mailRoja.insertAdjacentHTML('beforeend', `<li class="list-group-item">${el}</li>`))
                        
                        let alerta, nivel
                        let mails = []

                        matrixEditMail.forEach(el => {
                            el.addEventListener('click', () => {
                                alerta = el.getAttribute('alerta');
                                nivel = el.getAttribute('nivel');
                                matrixSetupMail.innerHTML = ''
                                matrixSetupMail.innerHTML = `
                                    <div class="alert alert-warning" role="alert">
                                        <p>Las direcciones de correo deben estar separadas por punto y coma ejemplo: <p>
                                        <p><strong>nombre.apellido@onelinkbpo.com;nombre.apellido@onelinkbpo.com<strong></p>
                                    </div>
                                    <h4>Nivel ${nivel}</h4>
                                    <textarea class="form-control" rows="3" id="matrix_Direcciones"></textarea>
                                `

                            })
                        })

                        matrixUpdateMail.addEventListener('click', () => {
                            mails = []
                            if(alerta === 'mailAmarilla') {
                                mails =[na, rj].toString()
                            } else if(alerta === 'mailNaranja') {
                                mails = [am, rj].toString()
                            } else {
                                mails = [am, na].toString()
                            }


                            let direcciones = document.querySelector('#matrix_Direcciones').value
                            if(direcciones){
                                if(mails.includes(direcciones)) {
                                    Swal.fire({
                                        html: `<span class="ml-n3 text-white">Alguna de las direcciones ya se ha configurado en otro nivel.</span>`,
                                        // timer: 3000,
                                        background: 'rgb(214, 60, 60)',
                                        position: "center",
                                        showCloseButton: true,
                                        showConfirmButton: false
                                    })
                                    return;
                                } else {
                                    let go = false;
                                    let validMail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                                    let direccion = direcciones.split(';')
                                    direccion.forEach(el => {
                                        if(!validMail.test(el)) {
                                            go = false;
                                            Swal.fire({
                                                html: `<span class="ml-n3 text-white">La dirección <em>${el}</em> no es válida, utilice un formato correcto para e-mail.</span>`,
                                                // timer: 3000,
                                                background: 'rgb(214, 60, 60)',
                                                position: "center",
                                                showCloseButton: true,
                                                showConfirmButton: false
                                            })
                                            return;
                                        } else {
                                            go = true;
                                        }
                                    })
                                    if(go) {
                                        this.updateMail(alerta, id, direcciones)
                                    }
                                }
                            } else {
                                Swal.fire({
                                    html: `<span class="ml-n3 text-white">No se ha registrado ninguna dirección.</span>`,
                                    // timer: 3000,
                                    background: 'rgb(214, 60, 60)',
                                    position: "center",
                                    showCloseButton: true,
                                    showConfirmButton: false
                                })
                                this.updateMail(alerta, id, 'No hay direcciones asociadas a este nivel!')
                            }
                        })

                        
                        
                    })

                    
                }

                listMail(a){
                    if(a){
                        a = a.split(';')
                    } else {
                        a = ['No hay direcciones asociadas a este nivel!']
                    }
                    return a
                }

                updateMail(a, b, c){
                    let datos = new FormData()
                    datos.append('alerta', a)
                    datos.append('subun', b)
                    datos.append('mail', c)
                    datos.append('updateMail', 'updateMail')

                    fetch('fetch/escalationMatrix.fetch.php', {
                        method: 'POST',
                        body: datos
                    })

                    .then(res => res.json())
                    .then(data => {
                        if(data === 'ok'){
                            this.renderMail();
                        } else {
                            Swal.fire({
                                html: `<span class="ml-n3 text-white">Se presentaron problemas guardando la información.</span>`,
                                // timer: 3000,
                                background: 'rgb(214, 60, 60)',
                                position: "center",
                                showCloseButton: true,
                                showConfirmButton: false
                            })
                        }
                        
                    })




                }

                

            
            } // End of class


            
            const matrixController = new EmSController();
            matrixController.unidades('unidades');
            
                            
            
            


            

        } //End of page validation

    } catch (e) {
        console.log(e);
    }

})

