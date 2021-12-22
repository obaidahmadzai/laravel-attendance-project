@if (count($students) < 1)

<p class="red-text center mt-5">NO Student Found!</p>
@else
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        @php
        $i = 1;
        @endphp
        @foreach ($students as $student )
        <tr>
            <td>{{ $i++ }}</td>
            <td width="50%" >{{ $student->name }} {{ $student->last_name }}</td>
            <td>

                <div >

                    <label>
                        <input name="option{{ $student->id }}[]"  value="1" class="with-gap" onclick="aem.toggleElementHide('#reason{{ $student->id }}')" type="radio"  />
                        <span>Present</span>
                    </label>


                    <label>
                        <input name="option{{ $student->id }}[]"  value="2" class="with-gap" onclick="aem.toggleElementHide('#reason{{ $student->id }}')"  type="radio"  />
                        <span>Absent</span>
                    </label>

                    <label>
                        <input name="option{{ $student->id }}[]"  value="3" class="with-gap" onclick="aem.toggleElement('#reason{{ $student->id }}')"   type="radio"  />
                        <span>Leave</span>
                    </label>

                </div>
                <div class="col s12 input-field" style="display: none" id="reason{{ $student->id}}" >
                    <input type="text" name="reason" id="reason">
                    <label>Reason</label>
                </div>



            </td>

        </tr>

        @endforeach

    </tbody>
      </table>
      </form>
      <br>
      <button type="submit" class="btn btn-small transparent black-text">
          Save
          <i class="material-icons black-text">save</i>
      </button>

@endif


