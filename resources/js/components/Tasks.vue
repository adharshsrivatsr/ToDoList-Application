<template>
    <div>
        <b-table selectable :items="items" :fields="fields" dark show-empty>
            <template slot='name' slot-scope="{item}">
                <div v-if='edit'>
                    <input type='text' name='name' class='form-control' v-model='name' required minlength=3 autocomplete="off" style='height:30px'>
                </div>
                <div v-else>
                    {{item.name}}
                </div>
            </template>
            
            <template slot='status' slot-scope='{item}'>
                <div v-if="item.status == '0'">
                    <font color='red'>Incomplete</font>
                    <!-- <button  @click='changeStatus'><p id='status'>Incomplete </p></button> -->
                 </div>
                
                <div v-else>
                    <font color='green'>Complete</font>
                    <!-- <button  @click='changeStatus'><p id='status'>Complete </p></button> -->
                </div>      
            </template>

            <template slot='priority' slot-scope='{item}'>
                <li v-for='prio in item.priorities'>
                    {{ prio.priority}} 
                </li>
            </template>

           <template slot=' ' slot-scope='{item}'>
               <button class='button is-primary' @click='showActivity'>Show info</button>
           </template>
        </b-table>

        <div class="control">
               <button class="button is-primary" v-show="!showInput" @click="addActivity" >Add Activity</button>
               <div v-show='showInput'>
                    
                    <form method="POST" action='/tasks' @submit.prevent='onSubmit'>
             
                        <div class='control'>
                            <input type='text' placeholder='Enter task here' name='name' class='form-control' v-model='name' required minlength=3 autocomplete="off"  style='height:30px'>
                        </div>
                        <div class='control'>
                            <input type='checkbox' value='Important'  class='form-control' size='22' v-model='priority' > Important <br>
                            <input type='checkbox' value='Urgent'  class='form-control' size='22' v-model='priority' /> Urgent <br>
                            <input type='checkbox' value='Ignore' class='form-control' size='22' v-model='priority' /> Ignore <br>
                            <input type='checkbox' value='Optional' class='form-control' size='22' v-model='priority'/> Optional <br>
                        </div>
                        <div class='control'>
                            <button class='button is-primary'>Submit!</button>
                        </div>
                    </form>

                </div>
        </div>
        
    </div>
    
</template>

<script>
    export default {
        data() {
            return {
                items: [],
                showInput:0,
                name:[],
                priority:[],
                errors:[],
                edit:0,
                fields:[
                    {
                        key:'name',
                        sortable:true
                    },
                   
                    {
                        key:'priority',
                        sortable:true
                    },
                    {
                        key:'status',
                        sortable:true
                    },
                    {
                        key:'created_at',
                        sortable:true
                    },
                    {
                        key:'updated_at',
                        sortable:true
                    },
                    {
                        key: ' '
                    }     
                ]
            }
        },
        created: function () {
            this.getTasks()
        },
        methods: {
            getTasks: function () {
                axios.get('/tasks')
                    .then(response => {
                        this.items = response.data
                
                    })  
                    
            },

          
            addActivity:function() {
               this.showInput= !this.showInput
               this.name='';
               
            
            },

            onSubmit:function() {
                axios.post('/tasks', this.$data)
                    .catch(error=> this.errors=error.response.data);
                
                window.location.reload();
                this.showInput=0;
                
            },

            showActivity: function() {
                //this.edit=1;
            }
            // changeStatus:function() {
            //     this.status=!this.status
                
            //     if(this.status == true)
            //         document.getElementById("status").innerHTML = "Completed";
            //     else
            //         document.getElementById("status").innerHTML = "Incomplete";
            //     console.log(this.status)
            // }
        }
    }
</script>


