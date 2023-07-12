<template>
    <div class="flex justify-between items-center bg-slate-50 border-2">
        <span class="w-full text-blue-500 text-center mx-8 my-8">
            Welcome ! {{name?name:'User'}}.
        </span>

        <div class="w-[300px] flex justify-between items-center  mt-2 cursor-pointer ">
            <div @click="addNewUser =true;addNewPost=false" class="cursor-pointer py-0.5 px-2 w-3/2 rounded-lg bg-transperent justify-center border-2 border-[#9333ea] flex gap-2 items-center">Add User</div>
            <div @click="addNewPost =true;addNewUser=false" class="cursor-pointer py-0.5 px-2 w-3/2 rounded-lg bg-transperent justify-center border-2 border-[#9333ea] flex gap-2 items-center">Add Post</div>
        </div>
    </div>

    <div class="w-full grid grid-cols-2">
        <div class="w-[450px] h-auto  border-2 rounded-md mx-8 bg-slate-100 mt-10" >
            <div v-if="tableData && tableData.data  && tableData.data.length" >
                <div  v-for="post in tableData.data"
                     class="h-[400px] bg-white w-full pr-5 rounded-lg p-2 flex gap-2 mt-5">
                    <div class="h-[7%]">
                        <img class="w-full h-10" :src="post.posted_by_img">
                    </div>
                    <div class="w-full h-[400px] ">
                        <p class="text-sm font-medium text-gray-700">{{post.posted_by_user}} <span class="text-gray-400">@{{post.posted_by_user}} </span></p>
                        <p class="text-sm font-medium text-gray-700 mt-1 break-words">{{post.title}}  </p>
                        <div  class="flex flex-wrap mt-3">
                            <div  >
                                <a href="#" class="text-sm font-medium text-[#9333ea] ml-2">
                                    {{post.description.length>20?post.description.slice(0,40)+'...':post.description}} </a>
                            </div>
                        </div>
                        <img class=" h-[60%] rounded-lg mt-1 mx-8" style="max-width: 85% !important;" :src="post.posted_img">
                        <div class="mt-3 flex justify-between items-center cursor-pointer">
                            <div class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-gray-700 text-xl">quick_phrases</span>
                                <p class="text-sm font-medium text-gray-700">0</p>
                            </div>
                            <div class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-gray-700 text-xl">favorite</span>
                                <p class="text-sm font-medium text-gray-700">90</p>
                            </div>
                            <div>
                                <span class="material-symbols-outlined text-gray-700 text-xl">share</span>
                            </div>
                            <div>
                                <span @click="edit(post)" class=" material-symbols-outlined text-gray-700 text-xl">edit</span>
                            </div>
                            <div>
                                <span  @click="deletePost(post.id)" class="material-symbols-outlined text-gray-700 text-xl">delete</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-3 flex justify-between items-center">
                    <div  v-if="this.page > 1" class="flex items-center gap-1 cursor-pointer ml-2">
                        <img @click="pagePath('prev')"  src="/project-assets/images/icons/square-arrow-left-svgrepo-com.svg" class="w-[30px] h-[30px]">
                    </div>
                    <div v-else></div>

                    <div  class="flex items-center gap-1">
                        <p class="text-sm font-medium text-gray-700">Current page : {{page}}</p>
                    </div>
                    <div  class="flex items-center gap-1">
                        <p class="text-sm font-medium text-gray-700">Last page : {{tableData.meta.last_page}}</p>
                    </div>
                    <div v-if="tableData && tableData.meta && page < tableData.meta.last_page" class="cursor-pointer mr-2">
                        <img  @click="pagePath('next')" src="/project-assets/images/icons/square-arrow-right-svgrepo-com.svg" class="w-[30px] h-[30px]">
                    </div>
                    <div v-else></div>
                </div>
            </div>
            <div v-else class="h-[400px] bg-white w-full pr-5 rounded-lg p-2 flex gap-2 mt-5">
               No Post found!
            </div>
        </div>

        <div v-if="addNewPost" class="w-[700px] h-2/4 border-2 rounded-md mx-8 bg-slate-100 mt-10 " >
            <div class="w-full p-5 family-inter relative">
                <div class="absolute top-0 p-5" title="Untitled post">Add New Post</div>
                 <div class="flex gap-6 justify-between pt-5">
                    <div class="w-full owerflow-x ">
                        <div class="bg-white w-full mt-5 rounded-lg border border-gray-200 p-6">
                            <div class="bg-white w-full mt-4 rounded-lg border border-gray-200 p-6">
                                <p class="text-sm font-semibold text-gray-800">Title</p>
                                <input v-model="title"  type="text" class="w-full  rounded-t-lg mt-5 bg-gray-50 border border-gray-200" placeholder="Enter Post Title">
                                <div class="text-vvs font-medium text-gray-700 mb-1 text-red-500">   {{errors && errors.title?errors.title[0]:""}}</div>
                            </div>

                            <div class="bg-white w-full mt-4 rounded-lg border border-gray-200 p-6">
                                <p class="text-sm font-semibold text-gray-800">Description</p>
                                <textarea v-model="description" class="w-full h-[100px] rounded-t-lg mt-5 bg-gray-50 border border-gray-200" placeholder="Enter description up to 10 words."></textarea>
                                <div class="text-vvs font-medium text-gray-700 mb-1 text-red-500">   {{errors && errors.description?errors.description[0]:""}}</div>
                            </div>

                            <div class="p-2 w-full border-dashed border border-gray-200 rounded-lg flex flex-wrap gap-2 mt-5">
                                <p class="text-sm font-semibold text-gray-800">Category</p>
                                <select v-model="category_id" class="bg-gray-50 rounded-md border border-gray-200">
                                    <option value="0" selected> Select Category</option>
                                    <option :value="cItem.id" v-for="cItem in category" >  {{cItem.name}}</option>

                                </select>
                                <div class="text-vvs font-medium text-gray-700 mb-1 text-red-500">   {{errors && errors.category_id?errors.category_id[0]:""}}</div>
                            </div>
                            <div class="p-2 w-full border-dashed border border-gray-200 rounded-lg flex flex-wrap gap-2 mt-5">
                                <p class="text-sm font-semibold text-gray-800">Status</p>
                                <select v-model="status" class=" bg-gray-50 rounded-md border border-gray-200">
                                    <option value="1" selected> Active</option>
                                    <option value="0"  > Inactive</option>

                                </select>
                                <div class="text-vvs font-medium text-gray-700 mb-1 text-red-500">   {{errors && errors.status?errors.status[0]:""}}</div>
                            </div>
                            <div class="flex justify-between items-center mt-2 cursor-pointer ">
                                <button @click.prevent="save" class="cursor-pointer py-0.5 px-2 w-3/2 rounded-lg bg-transperent justify-center border-2 border-[#9333ea] flex gap-2 items-center">Save</button>
                                <button @click.prevent="addNewPost=false" class="cursor-pointer py-0.5 px-2 w-3/2 rounded-lg bg-transperent justify-center border-2 border-[#9333ea] flex gap-2 items-center">Cancel</button>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
        <div v-if="addNewUser" class="w-[700px] h-2/4 border-2 rounded-md mx-8 bg-slate-100 mt-10 " >
            <div class="w-full p-5 family-inter relative">
                <div class="absolute top-0 p-5" title="Untitled post">Add New User</div>
                <div class="flex gap-6 justify-between pt-5">
                    <div class="w-full owerflow-x ">
                        <div class="bg-white w-full mt-5 rounded-lg border border-gray-200 p-6">
                            <div class="bg-white w-full mt-4 rounded-lg border border-gray-200 p-6">
                                <p class="text-sm font-semibold text-gray-800">Name</p>
                                <input v-model="name"  type="text" class="w-full  rounded-t-lg mt-5 bg-gray-50 border border-gray-200" placeholder="Enter Post Title">
                                <div class="text-vvs font-medium text-gray-700 mb-1 text-red-500">   {{errors && errors.name?errors.title[0]:""}}</div>
                            </div>

                            <div class="bg-white w-full mt-4 rounded-lg border border-gray-200 p-6">
                                <p class="text-sm font-semibold text-gray-800">Email</p>
                                <input v-model="email"  type="text" class="w-full  rounded-t-lg mt-5 bg-gray-50 border border-gray-200" placeholder="Enter Post Title">
                                <div class="text-vvs font-medium text-gray-700 mb-1 text-red-500">   {{errors && errors.name?errors.email[0]:""}}</div>
                            </div>

                            <div class="bg-white w-full mt-4 rounded-lg border border-gray-200 p-6">
                                <p class="text-sm font-semibold text-gray-800">Password</p>
                                <input v-model="password"  type="text" class="w-full  rounded-t-lg mt-5 bg-gray-50 border border-gray-200" placeholder="Enter Post Title">
                                <div class="text-vvs font-medium text-gray-700 mb-1 text-red-500">   {{errors && errors.name?errors.password[0]:""}}</div>
                            </div>

                            <div class="flex justify-between items-center mt-2 cursor-pointer ">
                                <button @click.prevent="saveUser" class="cursor-pointer py-0.5 px-2 w-3/2 rounded-lg bg-transperent justify-center border-2 border-[#9333ea] flex gap-2 items-center">Save</button>
                                <button @click.prevent="addNewUser=false" class="cursor-pointer py-0.5 px-2 w-3/2 rounded-lg bg-transperent justify-center border-2 border-[#9333ea] flex gap-2 items-center">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="editPost" class="w-[700px] h-2/4 border-2 rounded-md mx-8 bg-slate-100 mt-10 " >
            <div class="w-full p-5 family-inter relative">
                <div class="absolute top-0 p-5" title="Untitled post">Edit Post</div>
                <div class="flex gap-6 justify-between pt-5">
                    <div class="w-full owerflow-x ">
                        <div class="bg-white w-full mt-5 rounded-lg border border-gray-200 p-6">
                            <div class="bg-white w-full mt-4 rounded-lg border border-gray-200 p-6">
                                <p class="text-sm font-semibold text-gray-800">Title</p>
                                <input v-model="title"  type="text" class="w-full  rounded-t-lg mt-5 bg-gray-50 border border-gray-200" placeholder="Enter Post Title">
                            </div>

                            <div class="bg-white w-full mt-4 rounded-lg border border-gray-200 p-6">
                                <p class="text-sm font-semibold text-gray-800">Description</p>
                                <textarea v-model="description" class="w-full h-[100px] rounded-t-lg mt-5 bg-gray-50 border border-gray-200" placeholder="Enter description up to 10 words."></textarea>
                            </div>

                            <div class="p-2 w-full border-dashed border border-gray-200 rounded-lg flex flex-wrap gap-2 mt-5">
                                <p class="text-sm font-semibold text-gray-800">Category</p>
                                <select v-model="category_id" class="bg-gray-50 rounded-md border border-gray-200">
                                    <option value="0" selected> Select Category</option>
                                    <option :value="cItem.id" v-for="cItem in category" >  {{cItem.name}}</option>

                                </select>
                            </div>
                            <div class="p-2 w-full border-dashed border border-gray-200 rounded-lg flex flex-wrap gap-2 mt-5">
                                <p class="text-sm font-semibold text-gray-800">Status</p>
                                <select v-model="status" class=" bg-gray-50 rounded-md border border-gray-200">
                                    <option value="1" selected> Active</option>
                                    <option value="0"  > Inactive</option>

                                </select>
                            </div>
                            <div class="flex justify-between items-center mt-2 cursor-pointer ">
                                <button @click.prevent="updatePost" class="cursor-pointer py-0.5 px-2 w-3/2 rounded-lg bg-transperent justify-center border-2 border-[#9333ea] flex gap-2 items-center">Update</button>
                                <button @click.prevent="editPost=false" class="cursor-pointer py-0.5 px-2 w-3/2 rounded-lg bg-transperent justify-center border-2 border-[#9333ea] flex gap-2 items-center">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



</template>
<script>
    import Swal from 'sweetalert2'

    export default {
        name: "Dashboard",
        components: {},
        data(){
            return{
                errors:[],
                page:1,
                addNewPost:false,
                editPost:false,
                addNewUser:true,
                search:"",
                users:[],
                tableData:[],
                description:"",
                title:"",
                status:'',
                category:[],
                category_id:'',
                post_id:'',
                paginate:'',
                password:"",
                email:'',
                name:'',
                user_id:1

            }
        },
        methods:{
            fetchCategory(){
                axios.post( '/api/fetch-category').then(response => {
                    if(response.status === 200) {
                        this.category = response.data;
                    }
                }).catch((error) => {
                    console.log(error);
                })
            },
            fetchUsers(){
                axios.post( '/api/fetch-users').then(response => {
                    if(response.status === 200) {
                        this.users = response.data;
                    }
                }).catch((error) => {
                    console.log(error);
                })
            },
            save(){
                let payload={
                    title:this.title ,
                    description:this.description ,
                    category_id:this.category_id ,
                    status:this.status ,
                    posted_by:this.user_id
                };

                axios.post( '/api/store-post',payload).then(response => {
                    if(response.status === 200) {
                        this.fetchPost();
                        this.errors=[];
                        Swal.fire('Success','Post Created Successfully');
                    }
                    else{
                        Swal.fire('Error','Unable to create post!');
                    }

                }).catch((err) => {
                    if( err.response.status === 422 )
                    {
                        this.errors = err.response.data.errors
                    }
                    else{
                        console.log(err );
                    }
                })
            },
            fetchPost(){
                axios.post( '/api/fetch-post?page='+this.page).then(response => {
                    if(response.status === 200) {
                        this.tableData = response.data;
                        this.paginate =  this.tableData.mate;
                    }
                }).catch((c) => {
                    console.log(c)
                })
            },
            edit(postItem){
                this.editPost = true;
                this.post_id = postItem.id;
                this.title =postItem.title ;
                this.description  =postItem.description ;
                this.category_id  =postItem.category_id ;
                this.status  =postItem.is_active ;
            },
            updatePost(){
                let payload={
                    post_id: this.post_id,
                    title:this.title ,
                    description:this.description ,
                    category_id:this.category_id ,
                    status:this.status ,
                    posted_by:this.user_id
                };
                axios.post( '/api/update-post',payload).then(response => {
                    if(response.status === 200) {
                        this.fetchPost();
                        Swal.fire('Success','Post updated Successfully.');
                        return ;
                    }
                    Swal.fire('Error','Unable to updated post!');
                }).catch((error) => {
                    if (error.response.status === 500) {
                        Swal.fire(
                            'Oops!',
                            'Unable To Delete Category!'
                        )
                    }
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    }

                })



            },
            deletePost(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.post( '/api/delete-post/'+id).then(response => {
                            if(response.status === 200) {
                                this.fetchPost();
                                Swal.fire('Success','Post deleted Successfully');

                                return ;
                            }
                            Swal.fire('Error','Unable to delete post!');
                        }).catch((error) => {
                            this.errors = error.response.data.errors
                        })
                    }
                })
            },
            pagePath( val ){
                if( val == 'next' && this.page < this.tableData.meta.last_page ){
                    this.page = this.page+1;
                    this.fetchPost();

                }
                if( val == 'prev'  && this.page > 1){
                    this.page = this.page -1;
                    this.fetchPost();
                    //  3 > 2
                    //
                }

                console.log(val , this.page , this.tableData.meta.current_page , this.tableData.meta.last_page )
            },
            saveUser(){
                let payload={
                    name:this.name ,
                    email:this.email ,
                    password:this.password ,
                };

                axios.post( '/api/store-user',payload).then(response => {
                    if(response.status === 200) {
                        this.errors=[];
                        this.addNewPost = true;
                        Swal.fire('Success','User Created Successfully');

                        return ;
                    }
                    Swal.fire('Error','Unable to create user!');
                }).catch((error) => {
                    this.errors = error.response.data.errors
                })
            },
        },
        created(){
            this.fetchCategory();
            this.fetchUsers();
            this.fetchPost();
        }

    }
</script>

<style scoped>

</style>