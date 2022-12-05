from keras.models import load_model

# model.save('my_model.h5')  
# del model



# returns a compiled model
# identical to the previous one
model = load_model('my_model.h5')

# save as JSON
# json_string = model.to_json()

input_data = [[[0.2367155,1 ,0.41600722,  0.22212647, 0.00369531, 0.04242299,
   0.34768513, 0.08466312, 0.2002537,   0.22480062, 0.5430339,
    0.20405874, 0.61316478, 0.04335115, 0.43508142, 0.13710286,
   0.21528308, 0.08904853,  0.31309173, 0.00326887,  0.04372824,
   0.18112925, 0.1992695, 0.26289004, 0.12424441, 0.38141519,
   0.01270316, 0.03165409, 0.01426316, 0.11882945,  0.38492152,
   0.16239342,  0.33177894, 0.09640171,  0.42255092, 0.35714978,
    0.31906858, 0.33219188, 0.04519821, 0.56319141,  0.259051,
   0.04890257,  0.53861409, 0.21802609,  0.62862474, 0.15063697,
    0.35447836, 0.47680202,  0.34724528, 0.3274636,   0.22881629,
   0.38052616,  0.05748412, 0.21778773,  0.25804356,  0.07346082,
    0.38720542, 0.13877773,  0.40573624, 0.35123882,  0.33996367,
   0.57052177, 0.08952469, 0.39706618, 0.03040956, 0.06065869,
   0.11390105,  0.2912392, 0.08171705, 0.09668995, 0.09681936,
    0.09518347,  0.02048987, 0.04472836,  0.01963738, 0.19026694,
   0.0597855, 0.00848109,  0.04959317,  0.12043284, 0.25048807,
    0.42312336,  0.03255839,  0.6255433,  0.28076798,  0.35772166,
   0.3304086,  0.15204738, 0.38336924,  0.18415411, 0.20932557,
    0.16859527, 0.27899402,  0.32027525, 0.08766446,  0.6103189,
   0.11332616,  0.52092296, 0.50377816,  0.27665356, 0.44362208,
    0.0784026, 0.66492563,  0.15194577, 0.16553798,  0.43723205,
   0.22922912,  0.35372564, 0.37534201,  0.49275249, 0.38119578,
    0.13117109, 0.41436884, 0.08570186, 0.30557346, 0.11618852,
   0.05101594, 0.15380305, 0.13369028,  0.16483298,  0.05301969,
    0.15031727,  0.05114718,  0.22019206, 0.23970376, 0.18644276,
   0.11769722, 0.06264371,  0.05070489, 0.29375523,  0.21393906,
   0.21303834,  0.57348591, 0.11644157,  0.42513812, 0.15344979,
    0.33847779,  0.04801706,  0.23168533, 0.32424888, 0.03448349,
   0.20500793,  0.34470832, 0.13787034,  0.70785236, 0.03205021,
    0.75403154, 0.28858468,  0.42336631, 0.35349637,  0.40131396,
   0.37713897,  0.06721717, 0.39009672,  0.11102945, 0.28728497,
    0.55543125, 0.19364022,  0.52214217, 0.18381287,  0.45160225,
   0.19489922,  0.20871605, 0.37632683,  0.02489895, 0.38374913,
   0.1047423, 0.22759843,  0.43944621, 0.03706742,  0.23443088,
   0.0319044,  0.19757387,  0.01972915,  0.230259,   0.11440349,
   0.34319833, 0.17898826, 0.28459895,  0.09090251, 0.32040295,
    0.14082965, 0.04058974,  0.49527171, 0.00269492,  0.29371873,
   0.11150362,  0.08773969, 0.27442333,  0.06409373, 0.23441322,
    0.19867873, 0.34036317,  0.3525911, 0.45718423,  0.68781364,
   0.29951182,  0.63356125, 0.33702135,  0.41086608, 0.29297987]]]
batch_size = 1

predicted_output = model.predict(input_data, batch_size=batch_size)
print(predicted_output)

print('tes')