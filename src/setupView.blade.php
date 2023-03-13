<?php
use MoScim\Helper\CustomerDetails as CD;
use MoScim\Helper\DB as DB;

echo View::make('mo_scim::menuView');
?>
<style type="text/css">
      #apicreds table {
        width: 100%;
      }

      #apicreds table,
      #apicreds th,
      #apicreds td {
        border: 1px solid black;
      }

      #apicreds th,
      #apicreds td {
        padding: 10px;
      }

      #coldetails table {
        width: 70%;
      }

      #coldetails th,
      #coldetails td {
        padding: 10px;
      }
      #mo_scim_error {
        color: red;
        font-size: 1.5rem;
      }
    </style>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1>SCIM Settings</h1>
        </div>
    </div>
    <p id="oauth_message"></p>
    <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="row">
              <div class="col-lg-10" id="apicreds">
                <table>
                  <tr>
                    <th>SCIM Base URL</th>
                    <td>{{ Request::root() . '/scim/v2' }}</td>
                  </tr>
                  <tr>
                    <th>
                        SCIM Bearer token
                        <form action="generate-new-token" method="POST">
                            <input type="submit" name="tokenGenerationButton" class="btn btn-warning" value="Generate New Token">
                        </form>
                    </th>
                    <td>
                        {{ $bearerToken }}
                    </td>
                  </tr>
                </table>
              </div>

              <div class="col-lg-10" id="coldetails" style="margin-top: 20px;">
                <h4>Map the incoming SCIM attribute to the name column:</h4>
                <form method="POST" action="/attributeMapping" id="scim_attribute_mapping_form">
                  <input type="hidden" name="option" value="save_column_names">
                  <table>

                  <tr>
                    <th>name</th>
                    <td>
                    <select name="name" id="name">
                        <option value="">SCIM Attribute</option>
                        @foreach ($scimAttributes as $scimAttr)
                        <option value="{{ $scimAttr }}"
                        @if ($scimAttr == $name_option_selected)
                            selected="selected"
                        @endif
                        >{{ $scimAttr }}</option>
                        @endforeach
                    </select>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <input type="submit" class="btn btn-primary" name="submit" value="Save">
                    </td>
                  </tr>
                  </table>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
</main>
</body>
</html>