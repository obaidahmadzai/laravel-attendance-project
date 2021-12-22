
               @if ($subject->count() < 1)
               <p class="red-text center"> NO Subject Found </p>
               @else
               @php $i = 1; @endphp
               <table>
                <thead>
                    <tr>
                        <th>
                            #NO
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subject as $subject )
                    <tr>
                        <td>
                            {{ $i++ }}
                        </td>
                        <td class="names">
                            {{ $subject->name }}
                        </td>
                        <td>
                            @if ($subject->status)
                            <span class="green rounded p-2 white-text z-depth-1 " style="border-radius: 20%">Actice</span>
                            @else
                            <span class="red rounded p-2 white-text z-depth-1 " style="border-radius: 20%">Inactice</span>
                            @endif

                        </td>
                        <td>

                            <div style="display: inline-flex;">

                                    <button type="button" class="btn btn-small btn-floating transparent z-debth " onclick="aem._delete(event,'{{ route('subject.destroy',['subject'=>$subject->id,'_token'=>csrf_token()])}}','#list','ajax')">
                                        <i class="material-icons red-text">delete</i>

                                    </button>

                                <button type="button" class="btn btn-small btn-floating transparent z-debth" onclick="aem.modal('{{ route('subject.edit', $subject->id) }}')">
                                    <i class="material-icons yellow-text">edit</i>
                                </button>
                            </div>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
