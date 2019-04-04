<template>
    <div>
        <b-table  editable :items="items" :fields="fields" hover  fixed show-empty>
            <template slot='name' slot-scope="{item}">
                 <div> <b>{{item.name}}</b></div>
            </template>
            
            <template slot='status' slot-scope='{item}'>
                <div v-if="item.status == '0'">
                   <div class="progress-bar bg-danger progress-bar-striped" style="width:50%">Incomplete</div>
    
                 </div>
                
                <div v-else>
                    <div class="progress-bar bg-success progress-bar-striped" style="width:100%">Completed</div>
                </div>      
            </template>

            <template slot='priority' slot-scope='{item}'>
                <b v-for='prio in item.priorities' :key="prio.id">
                    <span v-if="prio.priority=='Urgent'" class="badge badge-danger">Urgent</span>
                    <span v-if="prio.priority=='Important'" class="badge badge-primary">Important</span>
                    <span v-if="prio.priority=='Optional'" class="badge badge-info">Optional</span> 
                    <span v-if="prio.priority=='Ignore'" class="badge badge-secondary">Ignore</span>
                </b>
            </template>
           
            <template slot=' ' slot-scope='{item}'>
                <div>
                  
                    <button style="float:right" class="button btn-warning" @click="editRow(item.id)">Show more</button>
                    <edit ref="modal" :updated_at="updated_at" :completed_at="completed_at" :initial_id="id" :edit="edit" :initial_name="name" :initial_status="status" :initial_prio="prio"></edit>
                </div>  
            </template>
     
        </b-table>

        <div class="container">
               <button class="button is-primary" style="float:right; border-radius: 55px;width: 55px; height: 55px;font-size: 35px; line-height: 5px" v-show="!showInput" @click="showInput= !showInput"><b >+</b>  </button>
               <div class="jumbotron" v-show='showInput'>
                    <div class='control'>
                            <input type='text' placeholder='Enter task name' v-model='name' required minlength=3 autocomplete="off" style='height:30px'> <br>
                        </div>
                        <br>
                        <div class='control'>
                            <input type='checkbox' value='Important' v-model='priority' > Important <br>
                            <input type='checkbox' value='Urgent' size='22' v-model='priority' /> Urgent <br>
                            <input type='checkbox' value='Optional' size='22' v-model='priority'/> Optional <br>
                            <input type='checkbox' value='Ignore' size='22' v-model='priority' /> Ignore <br>
                        </div>
                        
                        <div class='control'>
                            <br><button class='button is-primary' @click='onSubmit'>Submit!</button>
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
              
                prio:[ ], 
                priority:[],
                errors:[],
                edit:true,
                active:1,
                id:0,
                edit:0,
                name:"",
                status:"",
                completed_at:"",
                updated_at:"",
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
              
             if(this.name.length <3)
            {
                alert('Task name should have atleast 3 characters!')
                return;
            }
            if(this.$data.priority.length==0 )
             {
                alert('Choose atleast one priority!!')   
                return;
            }
            
           
               
                axios.post('/tasks', this.$data);
                this.showInput=0;
               // this.getTasks();
               window.location.reload();
            
            
           },

            editRow: function(id) {
             //   this.showModal= id;
                let test = this.items.find(x=>x.id===id);
                
                this.name=test.name
                this.id=test.id
                this.status=test.status
                this.completed_at=test.completed_at
                this.updated_at=test.updated_at
                this.prio=[ ]
                this.edit=0
                test.priorities.forEach(p => this.prio.push(p.priority))
                
                console.log(this.completed_at)

                let element = this.$refs.modal.$el
                $(element).modal('show')
            }
        }
    }
</script>

