            <!-- Breadcrumbs -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=URL::to('/')?>/">Dashboard</a></li>
                <li class="breadcrumb-item">Settings</li>
                <li class="breadcrumb-item"><a href="<?=URL::to('/')?>/settings/groups">Admin Groups</a></li>
                <li class="breadcrumb-item active">Add Group</li>
            </ol>

        <form method="POST" action="<?=URL::to('/')?>/settings/groups">
          @csrf
            <input type="hidden" name="action" value="add"> 
            <div class="form-group row">
              <label for="example-text-input" class="col-2 col-form-label">Group Name</label>
              <div class="col-10">
                <input class="form-control" type="text" value="" placeholder="" name="name">
              </div>
            </div>
            
            <div class="form-group row"> 
              <div class="col-10">
                <input type="submit" value="Save" class="btn btn-primary">
              </div>
            </div> 
            

        </form>
