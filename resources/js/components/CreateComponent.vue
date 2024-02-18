<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Create New Student</div>

                    <div class="card-body">
                        <form>
                         <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" v-model="name" class="form-control" id="name" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" v-model="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="number" v-model="phone" class="form-control" id="phone" placeholder="Enter phone">
                            </div>
                            <button type="submit" @click.prevent="saveStudent" class="btn btn-primary mt-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
                <div class="col-md-6">
                <div class="card">
                    <div class="card-header">All Students</div>

                    <div class="card-body">
                      <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(student,index) in students" :key="student.id">
                            <th scope="row">{{index + 1}}</th>
                            <td>{{student.name}}</td>
                            <td>{{student.email}}</td>
                            <td>{{student.phone}}</td>
                            <td>
                            <!-- Button trigger modal -->
                                <button type="button" @click="editStudent(student.id)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                                    Edit
                                </button>
                                <button type="button" @click="deleteStudent(student.id)" class="btn btn-danger ms-2">
                                    Del
                                </button>
                            <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                        <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" v-model="editname" class="form-control" id="name" placeholder="Name">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" v-model="editemail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="number" v-model="editphone" class="form-control" id="phone" placeholder="Enter phone">
                                            </div>
                                            <button type="submit" @click.prevent="updateStudent" data-bs-dismiss="modal" class="btn btn-success mt-2">Update</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary ">Save changes</button>
                                    </div>
                                    </div>
                                </div>
                                </div>

                            </td>
                            </tr>
                        </tbody>
                        </table>
                       
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</template>

<script>

        
    export default {
        data(){
            return{
                students:{},
                id: '',
                name:'',
                email:'',
                phone:'',
                editname:'',
                editemail:'',
                editphone:'',
            }
        },

        mounted() {
            this.allStudent();
            console.log('Component mounted.')
        },
        methods : {
           saveStudent(){
                axios.post('save_student',{
                    name: this.name,
                    email: this.email,
                    phone: this.phone,
                })
                .then(response => {
                    this.name = '',
                    this.email = '',
                    this.phone = '',
                    this.allStudent()                
                    })
                .then(response=>console.log(response))
           },
            allStudent(){
                axios.get('all_student')
                .then(response=>{this.students = response.data});
           },
           editStudent(id){
            axios.get('edit_student/' + id)
             .then(response => {
                 console.log(response)
                    this.id =  response.data.id,
                    this.editname =  response.data.name,
                    this.editemail =  response.data.email,
                    this.editphone =  response.data.phone        
                    })
           },
            updateStudent(){
                 axios.put('update_student/', {
                        id: this.id,
                        name: this.editname,
                        email:  this.editemail,
                        phone:  this.editphone,      
                        }).then(response=>{this.allStudent();})
           },
           deleteStudent(id){
             axios.delete('delete_student/' + id)
             .then(response=>{this.allStudent();})
           }
        }
       
    }
</script>
