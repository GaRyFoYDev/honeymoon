import numpy as np

class Recommendations:

    @staticmethod
    def cosine_similarity(vector1, vector2):
        dot_product = np.dot(vector1, vector2)
        norm_vector1 = np.linalg.norm(vector1)
        norm_vector2 = np.linalg.norm(vector2)
        
        cosine = dot_product / (norm_vector1 * norm_vector2)
        cosine = np.round(cosine, 4)
        return cosine


