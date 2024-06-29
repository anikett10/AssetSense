import json
import os
import platform

report_file_path = "C:/Users/Mrunmayi A/Documents/AIM.pbix"
response = {}

try:
    if platform.system() == "Windows":
        os.startfile(report_file_path)
    elif platform.system() == "Darwin":
        os.system("open " + report_file_path)
    elif platform.system() == "Linux":
        os.system("xdg-open " + report_file_path)
    else:
        raise NotImplementedError("Unsupported operating system")
    response['success'] = True
    response['message'] = "Report opened successfully"
except Exception as e:
    response['success'] = False
    response['error'] = str(e)

# Print the JSON response
print(json.dumps(response))
