window.addEventListener('load', () => {

    try {

        // JS File for Escalation Matrix

        file = ['adminUsuarios'];
        page = window.location.href.split('/');


        // Page code only if href match with the file const

        if(file[0] === page[4]){
         // Your code here
            

            class Usuario {

                elements() {
                    const el = {
                        buscar          :       document.querySelector('#usuarioBuscar'),
                        rol             :       document.querySelector('#usuarioRol'),
                        vistas          :       document.querySelector('#usuarioVistas'),
                        usuarioDatos    :       document.querySelector('#usuarioDatos'),
                        usuarioTabla    :       document.querySelector('#usuarioTabla'),
                        usuarioMenu     :       document.querySelector('#usuarioMenu'),
                        menuItems       :       document.querySelectorAll('.mnuItem') 
                    }

                    return el
                }

                searchUser() {
                    let elements = this.elements()
                    elements.buscar.addEventListener('keyup', () => {
                            elements.usuarioTabla.removeAttribute('hidden')
                            let user = elements.buscar.value;
                            let datos = new FormData()
                            datos.append('user', user)
                            fetch('fetch/user.fetch.php', {
                                method: 'POST',
                                body: datos
                            })
                            .then(res => res.json())
                            .then(data => {
                                if(data.nombre === null) {
                                    if(!elements.vistas.hasAttribute('hidden')) {
                                        elements.vistas.setAttribute('hidden', 'hidden')
                                    } 
                                    elements.usuarioDatos.innerHTML = `<tr><td colspan="6" class="text-center">No existe información para este usuario</td></tr>`
                                } else {
                                    elements.vistas.removeAttribute('hidden')
                                    elements.usuarioDatos.innerHTML = `
                                    <tr>
                                        <td scope="row">${data.tipDoc}</td>
                                        <td>${data.documento}</td>
                                        <td>${data.vhur}</td>
                                        <td>${data.nombre}</td>
                                        <td>${data.cargo}</td>
                                        <td>${data.estado}</td>
                                    </tr>
                                    `
                                    feather.replace();
                                    this.renderMenuItems(user, elements)
                                }
                                    
                                
                            })



                        
                        
                        
                    })
                }

                renderMenuItems(user, elements) {
                    let datos = new FormData()
                    datos.append('userMenu', user);
                    fetch('fetch/user.fetch.php', {
                        method: 'POST',
                        body: datos
                    })
                    .then(res => res.json())
                    .then(data => {
                        let activo = '';
                        let tipoDocumento
                        let documento
                        let vhur
                        elements.usuarioMenu.innerHTML = ''
                        for(let a of data) {
                            if(a.activo === '1') {
                                activo = 'checked'
                            } else {
                                activo = ''
                            }

                            tipoDocumento = a.tipodocumento
                            documento = a.documento
                            vhur = a.vhur
                            
                            elements.usuarioMenu.insertAdjacentHTML('beforeend', `
                            <div class="form-check col-md-3">
                                <label class="form-check-label">
                                <input type="checkbox" class="form-check-input mnuItem" texto="${a.texto}" value="${a.idmenuitem}" ${activo}>
                                ${a.texto}
                                </label>
                            </div>
                            `)
                        }

                        this.updateUser(tipoDocumento, documento, vhur);
                        
                    })

                }

                updateUser(tipoDocumento, documento, vhur) {
                    let elements = this.elements()
                    elements.menuItems.forEach(el => {
                        el.addEventListener('click', () => {
                            el.toggleAttribute('checked')
                            let activo;
                            (el.hasAttribute('checked')) ? activo = 1 : activo = 0
                                let datos = new FormData()
                                datos.append('tipoDocumento', tipoDocumento)
                                datos.append('documento', documento)
                                datos.append('vhur', vhur)
                                datos.append('idMenu', el.value)
                                datos.append('updateMenu', activo)
                                fetch('fetch/user.fetch.php', {
                                    method: 'POST',
                                    body: datos
                                })
                                .then(res => res.json())
                                .then(data => {
                                    Swal.fire({
                                        html: '<span class="ml-n3  py-4 text-white">Se han actualizado los permisos a la vista.</span>',
                                        timer: 1500,
                                        background: 'rgb(40, 116, 166)',
                                        // toast: true,
                                        position: "center",
                                        showConfirmButton: false
                                    })
                                })
                        })
                    })
                }

            }

        let usuario = new Usuario()
        usuario.searchUser()


        // Yoir code ends here            

        } //End of page validation

    } catch (e) {
        console.log(e);
    }

})

