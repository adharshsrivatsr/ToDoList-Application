<template>
    <div>
        <b-table  editable :items="items" :fields="fields" hover  fixed show-empty>
            <template slot='name' slot-scope="{item}">
                     {{item.name}}
            </template>
            
            <template slot='status' slot-scope='{item}'>
                <div v-if="item.status == '0'">
                    <font color='red'>Incomplete</font>
                 </div>
                
                <div v-else>
                    <font color='green'>Complete</font>
                </div>      
            </template>

            <template slot='priority' slot-scope='{item}'>
                <li v-for='prio in item.priorities' :key="prio.id">
                    {{prio.priority}} 
                </li>
            </template>
            
            <template slot=' ' slot-scope='{item}'>
                <div>
                    <button class="button is-primary" @click="editRow(item.id)">Show more</button>
                    <edit ref="modal" v-show="showModal" :initial_id="id" :edit="edit" :initial_name="name" :initial_status="status" :initial_prio="prio" ></edit>
                </div>  
            </template>
     
        </b-table>

        <div class="control">
               <button class="button is-primary" v-show="!showInput" @click="showInput= !showInput" >Add Task</button>
               <div v-show='showInput'>
                    <div class='control'>
                            <input type='text' placeholder='Enter task here' v-model='name' required minlength=3 autocomplete="off"  style='height:30px'>
                        </div>
                        <div class='control'>
                            <input type='checkbox' value='Important' v-model='priority' > Important <br>
                            <input type='checkbox' value='Urgent' size='22' v-model='priority' /> Urgent <br>
                            <input type='checkbox' value='Ignore' size='22' v-model='priority' /> Ignore <br>
                            <input type='checkbox' value='Optional' size='22' v-model='priority'/> Optional <br>
                        </div>
                        
                        <div> <p id="err"><font color="red"></font></p> </div>

                        <div class='control'>
                            <button class='button is-primary' @click='onSubmit'>Submit!</button>
                        </div>
                    </div>
                </div>
        </div>
    
</template>

<script>
    import edit from './Edit.vue';

    export default {

       components:{edit},

        data() {
            return {
                items: [],
                showInput:0,
                showModal:false,
                prio:[ ], 
                priority:[],
                errors:[],
                edit:true,
                active:1,
                id:0,
                edit:0,
                name:"",
                status:"",
                toPass:[],
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

            onSubmit: function() {
              
             if(this.$data.priority.length==0 )
             {
                document.getElementById("err").innerHTML = "Select atleast one priority!"
             }
            
            else
            {    
            axios.post('/tasks', this.$data)
                    .catch(error=> this.errors=error.response.data);
                 console.log(this.$data)
                //window.location.reload();
                this.showInput=0;
            }
            },

            editRow: function(id) {
             //   this.showModal= id;
                let test = this.items.find(x=>x.id===id);
                
                this.name=test.name
                this.id=test.id
                this.status=test.status
                this.prio=[ ]
                this.edit=0
                test.priorities.forEach(p => this.prio.push(p.priority))
                
               // console.log(this.prio)

                let element = this.$refs.modal.$el
                $(element).modal('show')
            }
        }
    }
</script>

